<?php

namespace MicroweberPackages\Shop\Http\Controllers;

use Illuminate\Http\Request;
use MicroweberPackages\Blog\FrontendFilter\FilterHelper;
use MicroweberPackages\Product\Models\Product;

class LiveEditAdminController
{
    public function index(Request $request)
    {
        $query = Product::query();
        $query->with('tagged');

        $contentFromId = get_option('content_from_id', $request->get('id'));
        if ($contentFromId) {
            $query->where('parent', $contentFromId);
        }

        $results = $query->get();

        $customFieldNames = [];
        if (!empty($results)) {
            foreach ($results as $result) {
                $resultCustomFields = $result->customField()->with('fieldValue')->get();
                foreach ($resultCustomFields as $resultCustomField) {

                    //$customFieldControlType = FilterHelper::getFilterControlType($customField, $moduleId);

                    $customFieldNames[$resultCustomField->name_key] = $resultCustomField;
                }
            }
        }

        return view('blog::admin.live_edit', [
            'moduleId'=>$request->get('id'),
            'customFieldNames'=>$customFieldNames
        ]);
    }

}
