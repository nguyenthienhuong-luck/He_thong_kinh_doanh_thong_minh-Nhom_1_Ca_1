<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BankBranchController extends Controller
{
  public function index()
  {
    return view('bank_branches.index', [
      'branches' => [],
      'query' => "",
      'user' => User::find(Auth::user()->id)
    ]);
  }

  public function search(Request $request)
  {
    $query = $request->input('query', ''); // Tên ngân hàng
    $latitude = $request->input('latitude', 21.007118); // Tọa độ mặc định của Đại học Thủy Lợi
    $longitude = $request->input('longitude', 105.825195); // Tọa độ mặc định của Đại học Thủy Lợi

    if (empty($query)) {
      return back()->withErrors('Please enter a bank name to search.');
    }

    // Gửi yêu cầu tới Overpass API
    $response = Http::withHeaders([
      'User-Agent' => 'YourAppName/1.0 (your_email@example.com)',
    ])->withoutVerifying()->get('https://overpass-api.de/api/interpreter', [
      'data' => '[out:json];node["amenity"="bank"]["name"~"' . $query . '"](' . ($latitude - 0.1) . ',' . ($longitude - 0.1) . ',' . ($latitude + 0.1) . ',' . ($longitude + 0.1) . ');out;',
    ]);

    $data = $response->json();

    $branches = isset($data['elements']) ? collect($data['elements'])->map(function ($item) {
      return [
        'name' => $item['tags']['name'] ?? 'Unknown Bank', // Lấy tên ngân hàng
        'latitude' => $item['lat'], // Lấy tọa độ vĩ độ
        'longitude' => $item['lon'], // Lấy tọa độ kinh độ
      ];
    }) : collect();

    return view('bank_branches.index', [
      'branches' => $branches,
      'query' => $query,
    ]);
  }
}
