<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        return view('admin.articles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'titre' => 'required|string',
            'descriptioion' => 'nullable|string',
            'prix' => 'required|numeric',
            'image' => 'required|file',
            'quantitee' => 'required|integer',
        ]);

        $url = null;
        if ($request->hasFile('image')) {
            $url = $this->storeImage($request->file('image'));
        }

        Article::create([
            'titre' => $request->input('titre'),
            'description' => $request->input('descriptioion'),
            'prix' => $request->input('prix'),
            'url' => $url,
            'qteStocks' => $request->input('quantitee'),
        ]);

        return redirect()->route('admin.articles.index');
    }

    public function edit(int $id): View
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'titre' => 'required|string',
            'descriptioion' => 'required|string',
            'prix' => 'required|numeric',
            'Quantitee' => 'required|integer',
            'image' => 'nullable|file',
        ]);

        $article = Article::findOrFail($id);
        $url = $article->url;

        if ($request->hasFile('image')) {
            $url = $this->storeImage($request->file('image'));
        }

        $article->update([
            'titre' => $request->input('titre'),
            'description' => $request->input('descriptioion'),
            'prix' => $request->input('prix'),
            'qteStocks' => $request->input('Quantitee'),
            'url' => $url,
        ]);

        return redirect()->route('admin.articles.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.articles.index');
    }

    private function storeImage($file): string
    {
        $filename = $file->getClientOriginalName();
        $destination = public_path('image');
        $file->move($destination, $filename);

        $this->compressToPrefixed($destination, $filename);

        return $filename;
    }

    private function compressToPrefixed(string $destination, string $filename): void
    {
        $sourcePath = $destination . DIRECTORY_SEPARATOR . $filename;
        $targetPath = $destination . DIRECTORY_SEPARATOR . 'M' . $filename;

        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $img = @imagecreatefromjpeg($sourcePath);
                break;
            case 'png':
                $img = @imagecreatefrompng($sourcePath);
                break;
            case 'gif':
                $img = @imagecreatefromgif($sourcePath);
                break;
            case 'webp':
                $img = @imagecreatefromwebp($sourcePath);
                break;
            default:
                $img = null;
        }

        if ($img === false || $img === null) {
            @copy($sourcePath, $targetPath);
            return;
        }

        // Vignette plus petite et plus compressée pour un rendu moins net
        $maxWidth = 400;
        $maxHeight = 400;
        $width = imagesx($img);
        $height = imagesy($img);

        $ratio = min($maxWidth / $width, $maxHeight / $height, 1);
        $newWidth = (int)($width * $ratio);
        $newHeight = (int)($height * $ratio);

        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resized, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Compression très forte (qualité 5)
        imagejpeg($resized, $targetPath, 5);

        imagedestroy($resized);
        imagedestroy($img);
    }
}

