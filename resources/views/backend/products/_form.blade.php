 <div class="row">
     <div class="col-6">
         <div class="form-group">
             <x-form.label for="name" value="Name" />
             <x-form.input type="text" name="name" :value="old('name', $product->name)" />
         </div>
     </div>

     <div class="col-6">
         <div class="form-group">
             <x-form.label for="description" value="Description" />
             <x-form.textarea name="description" :value="$product->description"></x-form.textarea>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-4">
         <div class="form-group">
             <x-form.label for="price" value="Price" />
             <x-form.input type="number" name="price" :value="old('number', $product->price)" />
         </div>

     </div>

     <div class="col-4">
         <div class="form-group">
             <x-form.label for="quantity" value="Quantity" />
             <x-form.input type="number" name="quantity" :value="old('quantity', $product->quantity)" />
         </div>
     </div>

     <div class="col-4">
         <div class="form-group">
             <x-form.label for="category" value="Category" />
             <x-form.select name="category_id" :options="$categories" :selected="$product->category_id" />


         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-4">
         <div class="form-group">
             <x-form.label for="subcategory" value="Subcategory" />
             <x-form.select name="subcategory_id" :options="$subcategories" :selected="$product->subcategory_id" />
         </div>
     </div>

     <div class="col-4">
         <div class="form-group">
             <x-form.label for="brand" value="Brand" />
             <x-form.select name="brand_id" :options="$brands" :selected="$product->brand_id" />
         </div>
     </div>
     <div class="col-4">
         <div class="form-group">
             <x-form.label for="status" value="Status" />
             <x-form.select name="status" :options="['active' => 'Active', 'inactive' => 'Inactive']" :selected="$product->status" />
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-12">
         <x-form.label for="image" value="Image" />
         <img src="" alt="" class="w-100 form-control">
         <x-form.input type="file" name="image" id="image" value="" />
     </div>
 </div>

 @if ($product->image)
     
 <div class="row">
     <div class="col-12 mt-3">
         <img src="{{ asset('dist/img/products/' . $product->image) }}" alt="" class="w-25">
        </div>
    </div>
    @endif

 <div class="row">
     <div class="col-12 mt-3">
         <button type="submit" class="btn btn-dark form-control">{{$button}}</button>
     </div>
 </div>
