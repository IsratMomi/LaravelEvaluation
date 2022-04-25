@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#productModal">Add Products</a>
                    <table class="table" id="productTable">
                        <thead>
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category-id</th>
                            <th scope="col">Subcategory-id</th>
                            <th scope="col">Price</th>
                            <th scope="col">Thumbnail</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post" id="productForm">
            @csrf
            <div class="modal-body">


                <div class="form-group row">
                    <label for="" class="col-md-4 text-right"> Product Title : </label>
                    <div class="col-md-8">
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4 text-right"></label>
                    <div class="col-md-8">
                        <select name="category_id" id="categoryId" class="form-control">
                            <option value="" disabled selected>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4 text-right">Select a category:</label>
                    <div class="col-md-8">
                        <select name="subcategory_id" id="subCategoryId" class="form-control">
                            <option value="" disabled selected>Select a sub category</option>
                            @foreach($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}">{{ $subCategory->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4 text-right"> Price</label>
                    <div class="col-md-8">
                        <input type="text" name="price" class="form-control" id="price">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4 text-right">Product  Description :</label>
                    <div class="col-md-8">
                        <textarea name="description" class="form-control ckeditor" id="description" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4 text-right">Product  thumbnail :</label>
                    <div class="col-md-8">
                        <textarea name="thumbnail" class="form-control" id="thumbnail" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Product</button>
            </div>
         </form>

      </div>
    </div>
</div>

{{-- delete modal --}}
<div class="modal fade" id="deleteproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="delete_product_id">
            <h4>Are you sure to delete this product?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary delete_product_btn">Yes Delete</button>
        </div>

      </div>
    </div>
</div>

@section('custom-js')
<script type="text/javascript">


    $(document).ready(function(){
      $('#productForm').on('submit',function(e){
          e.preventDefault();
          $.ajax({
              type: "POST",
              url : "/add-product",
              data : $('#productForm').serialize(),
              success: function(response){
                  console.log(response);
                  $('#productModal').modal('hide')
                  alert("Data Saved")
              },
              error: function(error){
                  console.log(error)
                  alert("Data Not saved");
              }
          });
      });

        fetchproduct();
        function fetchproduct(){
            $.ajax({
                type: "GET",
                url : "/fetch-products",
                dataType:"json",
                success : function(response){
                    $('tbody').html("");
                    $.each(response.products, function(key, item){
                        $('tbody').append('<tr>\
                        <td>'+item.id+'</td>\
                        <td>'+item.title+'</td>\
                        <td>'+item.category_id+'</td>\
                        <td>'+item.subcategory_id+'</td>\
                        <td>'+item.price+'</td>\
                        <td>'+item.thumbnail+'</td>\
                        <td><button type="button" value="'+item.id+'" class="delete_product btn btn-danger">Delete</button></td>\
                        </tr>')
                    });

                }
            });
        }
        $(document).on('click','.delete_product', function(e){
            e.preventDefault();
            var product_id = $(this).val();
            // alert(product_id);
            $('#delete_product_id').val(product_id);
            $('#deleteproductModal').modal('show');

        });
        $(document).on('click','.delete_product_btn', function(e){
            e.preventDefault();

            var product_id = $('#delete_product_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url : "/delete-product/"+product_id,
                success: function (response){
                    // console.log(response);
                    $('#success_message').addClass('alert alert-message');
                    $('#success_message').text(response.message);
                    $('#deleteproductModal').modal('hide');
                    fetchproduct();
                }
            });
        });
    });
  </script>
@endsection



