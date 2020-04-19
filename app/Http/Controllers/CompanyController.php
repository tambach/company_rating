<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $keyword  = isset($request->keyword)  ? $request->keyword  : '';
        $cat_id   = isset($request->category) ? $request->category : '';
        $per_page = isset($request->per_page) ? $request->per_page : 8;

        $companies = DB::table('companies')
            ->join('categories', 'category_id', '=','categories.id')
            ->when($keyword , function ($query, $keyword) {
                return  $query->where(function (Builder $query) use ($keyword) {
                    $query->where('companies.name','LIKE','%'.$keyword.'%')
                        ->orWhere('companies.address','LIKE','%'.$keyword.'%');
                });
            })
            ->when($cat_id , function ($query, $cat_id) {
                return  $query->where(function (Builder $query) use ($cat_id) {
                    $query->where('category_id', '=', $cat_id);
                });
            })
            ->whereRaw('image is not null and image != 0')
            ->selectRaw('companies.*, categories.name as cat_name')
            ->orderByDesc('created_at')
            //->toSql();
            ->paginate($per_page);

        return $companies;
    }

    public function getCompanyByCategory(Request $request)
    {
        $cat_id = $request->id;
        $per_page = isset($request->per_page) ? $request->per_page : 8;

        $companies = DB::table('companies')
            ->join('categories', 'category_id', '=','categories.id')
            ->where('category_id', '=', $cat_id)
            ->whereRaw('image is not null and image != 0')
            ->selectRaw('companies.*, categories.name as cat_name')
            ->orderByDesc('created_at')
            ->paginate($per_page);

        return $companies;
    }

    public function getCompanyByID($id)
    {
        $data = Company::find($id);
       return $data;
    }
}
