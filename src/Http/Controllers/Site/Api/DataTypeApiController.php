<?php
namespace BitPixel\SpringCms\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use BitPixel\SpringCms\Models\DataType;
use BitPixel\SpringCms\Models\FieldValue;
use BitPixel\SpringCms\Models\Portfolio;
use Illuminate\Http\Request;

class DataTypeApiController
{

    public function index(Request $request, $slug)
    {
        $d = DataType::slug($slug)->first();
        $dataTypeService = new \BitPixel\SpringCms\Services\DataTypeService();
        $f = $dataTypeService->getFields($slug);

        $fields = FieldValue::where('data_type_id', $d->id)
            ->get();
        $fields = $fields->groupBy('data_entry_id');

        $all_data = [];
        foreach ($fields as $id => $item) {
            $single = [];
            $single['id'] = $id;
            $entry = \BitPixel\SpringCms\Models\DataEntry::find($id);
            if ($entry) {
                $single['title'] = $entry->title;
                $single['slug'] = $entry->slug;
                $single['content'] = $entry->content;
                $single['featured_image'] = $entry->featured_image;
                $single['order'] = $entry->order;
            }
            foreach ($item as $field_val) {
                $single[$field_val->data_field_slug] = $field_val->value;
            }
            $all_data[] = $single;
        }

        // if ($filter) {
        //     foreach ($filter as $key => $value) {
        //         $all_data = collect($all_data)->where($key, $value)->values()->toArray();
        //     }
        // }

        
        return response()->json([
            'success' => true,
            'data' => $all_data
        ]);

        // Return paginated response
        // return response()->json([
        //     'data' => $data
        // ]);
    }
    
    public function show(Request $request, $slug)
    {
        $data = Portfolio::where('slug', $slug)->first();

        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

}
