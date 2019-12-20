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
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
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
            'name'=>'cateRelation.name'
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
