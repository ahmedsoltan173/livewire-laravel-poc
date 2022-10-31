<?php

namespace App\Http\Livewire;

use App\Models\product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

    public   $name , $details , $price, $product_edit_id;

    public $view_id,$view_name,$view_details,$view_price;

    //input fields on update validation



    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name'=>'required|min:5|max:20',
            'details'=>'required|min:5|max:200',
            'price'=>'required|numeric',
        ]);

    }
/**
 *============================================
 *== to store product ========================
 *============================================
*/

    public function storeProductData(){
        $this->validate([
            'name'=>'required|min:5|max:20',
            'details'=>'required|min:5|max:200',
            'price'=>'required|numeric',
        ]);
        //
        $product=product::create([
            'name'=>$this->name,
            'details'=>$this->details,
            'price'=>$this->price,
            'user_id'=>1
        ]);

        session()->flash('message','New Product has been added successfully');

        $this->name='';
        $this->details='';
        $this->price='';

        //for hide model after product added
        $this->dispatchBrowserEvent('close-add-modal');
    }

/**
 *============================================
 *== to edit product ========================
 *============================================
*/
public function resetInputs(){
    $this->name='';
    $this->details='';
    $this->price='';
    $this->product_edit_id="";
}
/**
 *============================================
 *== to edit product ========================
 *============================================
*/
public function editProductData($id){
    $product=product::find($id);
    $this->name=$product->name;
    $this->details=$product->details;
    $this->price=$product->price;
    $this->product_edit_id=$product->id;
    $this->dispatchBrowserEvent('show-edit-product-modal');
}
/**
 *============================================
 *== to update product ========================
 *============================================
*/
public function updateProductData(){
    $this->validate([
        'product_edit_id'=>'required|unique:products,id,'.$this->product_edit_id.'',
        'name'=>'required|min:5|max:20',
        'details'=>'required|min:5|max:200',
        'price'=>'required|numeric',
    ]);
    $product=product::find($this->product_edit_id);
    if(isset($product)){
        $product->update([
            'name'=>$this->name,
            'details'=>$this->details,
            'price'=>$this->price,
            'user_id'=>1
        ]);
        session()->flash('message','Product has been updated successfully');
        $this->dispatchBrowserEvent('close-add-modal');
    }
}

/**
 *============================================
 *== to delete product ========================
 *============================================
*/
public function cancel(){
    $this->product_edit_id='';

}

public function deleteConfirmation($id){
    $product=product::find($this->product_edit_id);
    $this->product_edit_id=$id;
    $this->dispatchBrowserEvent('show-delete-product-modal');
    }

public function deleteProductData(){
    $product=product::find($this->product_edit_id);
    if(isset($product)){
        $product->delete();

        session()->flash('message','Product has been Deleted successfully');
        $this->dispatchBrowserEvent('close-add-modal');
    }
}

/**
 * View product info
 *
 */
public function showProductData($id){
    $product=product::find($id);
    $this->view_name=$product->name;
    $this->view_details=$product->details;
    $this->view_price=$product->price;
    $this->view_id=$product->id;

    $this->dispatchBrowserEvent('show-product-info-modal');
}


    public function render()
    {

        $products=product::paginate(10);
        return view('livewire.products',['products'=>$products])->layout('livewire.layout.base');
    }
}
