<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- Tambahan penting untuk ngatur file

class ItemController extends Controller
{
    // GET /api/items — semua orang (termasuk yang belum login) boleh lihat
    // Parameter opsional: status, search, page, per_page
    public function index(Request $request)
    {
        $query = Item::query()->latest()->orderByDesc('id');

        if ($request->filled('status')) {
            $query->where('status', (string) $request->query('status'));
        }

        if ($request->filled('search')) {
            $keyword = '%' . (string) $request->query('search') . '%';

            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', $keyword)
                    ->orWhere('location', 'like', $keyword)
                    ->orWhere('description', 'like', $keyword);
            });
        }

        // Jumlah per halaman: default 8, minimal 1, maksimal 50
        $perPage = min(max($request->integer('per_page', 8), 1), 50);

        return response()->json($query->paginate($perPage));
    }