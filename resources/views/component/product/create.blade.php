<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">


                                <label class="form-label">Product ID</label>
                                <input type="text" class="form-control" id="productID">

                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="productName">

                                <label class="form-label mt-2">Description</label>
                                <input type="text" class="form-control" id="productDescription">

                                <label class="form-label mt-2">Price</label>
                                <input type="text" class="form-control" id="productPrice">

                                <label class="form-label mt-2">Stock</label>
                                <input type="text" class="form-control" id="productStock">

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImg">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-danger mx-2 text-light fs-5" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn bg-info text-light fs-5" >Save</button>
            </div>
        </div>
    </div>
</div>

<script>


    async function Save(){
        let productID = document.getElementById('productID').value;
        let productName = document.getElementById('productName').value;
        let productDescription = document.getElementById('productDescription').value;
        let productPrice = document.getElementById('productPrice').value;
        let productStock = document.getElementById('productStock').value;
        let productImg = document.getElementById('productImg').files[0];

        if (productID.length === 0) {
            errorToast("Product ID Required !")
        }
        else if(productName.length===0){
            errorToast("Product Name Required !")
        }
        else if(productDescription.length===0){
            errorToast("Product Description Required !")
        }
        else if(productPrice.length===0){
            errorToast("Product Price Required !")
        }
        else if(productStock.length===0){
            errorToast("Product Stock Required !")
        }
        else if(!productImg){
            errorToast("Product Image Required !")
        }

        else {
            document.getElementById('modal-close').click();

            let formData = new FormData();
            formData.append('product_id', productID)
            formData.append('name', productName)
            formData.append('description', productDescription)
            formData.append('price', productPrice)
            formData.append('stock', productStock)
            formData.append('img', productImg)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/product-create", formData, config)
            hideLoader();

            if (res.status === 201) {
                successToast('Request completed');
                document.getElementById("save-form").reset();
                await getList();
            } else {
                errorToast("Request fail !")
            }
        }
    }
</script>



