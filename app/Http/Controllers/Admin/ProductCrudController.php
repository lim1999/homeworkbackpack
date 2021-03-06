<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/product');
        $this->crud->setEntityNameStrings('product', 'products');
        //$this->crud->addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addFilter([
            'name'  => 'name',
            'type'  => 'select2',
            'label' => 'Name'
          ], function () {
            return \App\Models\Product::pluck('name', 'id')->toArray();
          }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'id', $value);
          });
          $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'trashed',
            'label'=> 'Trashed'
          ],
          false,
          function($values) { // if the filter is active
            $this->crud->addClause('onlyTrashed');
            //   $this->crud->query = $this->crud->query->onlyTrashed();
          });
        $this->crud->addColumn([
            'name'=>'Code',
            'label'=>'ID'
        ]);
        $this->crud->addColumn([
            'name'=>'name',
            'label'=>'Name'
        ]);
        $this->crud->addColumn([
            'label'=>'CategoryName',
            'name'=>'categories.name'
        ]);
        $this->crud->addColumn([
            'name'=>'rent_price',
            'label'=>'Rent Price'
        ]);
        $this->crud->addColumn([
            'name'=>'sale_price',
            'label'=>'Sale Price'
        ]);
        $this->crud->addColumn([
            'name'=>'list_price',
            'label'=>'List_price'
        ]);
        $this->crud->addColumn([
            'name'=>'sold_price',
            'label'=>'Sold_Price'
        ]);
        $this->crud->addColumn([
            'name'=>'profile',
            'label'=>'Profile',
            'type' => 'image',
            'height' => '30px',
            'width' => '30px',
        ]);
     //    /Storage::disk('uploads')->url($file);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField([
            'name'=>'name',
            'label'=>'Name',
            'wrapperAttributes'=>[
                'class'=>'form-group col-6'
            ]
        ]);
        $this->crud->addField([
            'label'=>'CategoryName',
            'type'=>'select',
            'name'=>'category_id',
             'entity'=>'categories',
             'attribute'=>'name',
            'model'=>'App\Models\Category',
            'wrapperAttributes' => [
                     'class' => 'form-group col-6'
                ],
        ]);
        $this->crud->addField([
            'name'=>'rent_price',
            'label'=>'Rent Price',
            'wrapperAttributes'=>[
                'class'=>'form-group col-6'
            ]
        ]);
        $this->crud->addField([
            'name'=>'sale_price',
            'label'=>'Sale Price',
            'wrapperAttributes'=>[
                'class'=>'form-group col-6'
            ]
        ]);
        $this->crud->addField([
            'name'=>'list_price',
            'label'=>'List Price',
            'wrapperAttributes'=>[
                'class'=>'form-group col-6'
            ]
        ]);
        $this->crud->addField([
            'name'=>'sold_price',
            'label'=>'Sold Price',
            'wrapperAttributes'=>[
                'class'=>'form-group col-6'
            ]
        ]);
        $this->crud->addField([ // image
            'label' => "Profile",
            'name' => 'profile',
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => 'category-profiles',
            // 'disk' => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
            'wrapperAttributes' => [
                'class' => 'col-6',
            ],
        ]);
        
    }

    protected function setupUpdateOperation()
    {
        //$this->setupCreateOperation();
        $this->crud->addField([
            'name'=>'name',
            'label'=>'Name',
            'wrapperAttributes'=>[
                'class'=>'col-6'
            ]
        ]);
        $this->crud->addField([
            'label'=>'CategoryName',
            'type'=>'select',
            'name'=>'category_id',
            'entity'=>'categories',
            'attribute'=>'name',
            'model'=>'App\Models\Category',
            'wrapperAttributes' => [
                     'class' => 'col-6'
                ],
        ]);
        $this->crud->addField([
            'name'=>'rent_price',
            'label'=>'Rent Price',
            'wrapperAttributes'=>[
                'class'=>'col-6'
            ]
        ]);
        $this->crud->addField([
            'name'=>'sale_price',
            'label'=>'Sale Price',
            'wrapperAttributes'=>[
                'class'=>'col-6'
            ]
        ]);
        $this->crud->addField([
            'name'=>'list_price',
            'label'=>'List Price',
            'wrapperAttributes'=>[
                'class'=>'col-6'
            ]
        ]);
        $this->crud->addField([
            'name'=>'sold_price',
            'label'=>'Sold Price',
            'wrapperAttributes'=>[
                'class'=>'col-6'
            ]
        ]);
        
    }
}
