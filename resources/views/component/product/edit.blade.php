<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">


                                <label class="form-label">Product ID</label>
                                <input type="text" class="form-control" id="updateproductID" readonly>

                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="updateproductName">

                                <label class="form-label mt-2">Description</label>
                                <input type="text" class="form-control" id="updateproductDescription">

                                <label class="form-label mt-2">Price</label>
                                <input type="text" class="form-control" id="updateproductPrice">

                                <label class="form-label mt-2">Stock</label>
                                <input type="text" class="form-control" id="updateproductStock">

                                <br/>
                                <img class="w-15" id="oldImgPath" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="oldImgPath.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="updateproductImg">


                                <input type="text" class="d-none" id="oldImg">


                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>

        </div>
    </div>
</div>

<script>
   async function FillUpUpdateForm(filePath,product_id){

       document.getElementById('oldImg').value=filePath;
       document.getElementById('oldImgPath').src=filePath;

       let res=await axios.post("/by-product-id",{product_id:product_id})
       document.getElementById('updateproductID').value=res.data['product_id'];
       document.getElementById('updateproductName').value=res.data['name'];
       document.getElementById('updateproductDescription').value=res.data['description'];
       document.getElementById('updateproductPrice').value=res.data['price'];
       document.getElementById('updateproductStock').value=res.data['stock'];
    }

    async function update(){

        let productID = document.getElementById('updateproductID').value;
        let productName = document.getElementById('updateproductName').value;
        let productDescription = document.getElementById('updateproductDescription').value;
        let productPrice = document.getElementById('updateproductPrice').value;
        let productStock = document.getElementById('updateproductStock').value;
        let file_path = document.getElementById('oldImg').value;
        let productImg = document.getElementById('updateproductImg').files[0];

        if (productName.length === 0) {
            errorToast("Product Name Required !")
        }
        else if(productDescription.length===0){
            errorToast("Product Des Required !")
        }
        else if(productPrice.length===0){
            errorToast("Product Price Required !")
        }

        else if(productStock.length===0){
            errorToast("Product Stock Required !")
        }

        else if(productImg===null){
            errorToast("Product Image Required !")
        }
        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('product_id',productID)
            formData.append('name',productName)
            formData.append('description',productDescription)
            formData.append('price',productPrice)
            formData.append('stock',productStock)
            formData.append('file_path',file_path)
            formData.append('img',productImg)


            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            showLoader();
            let res = await axios.post("/product-edit",formData,config)
            console.log(res)
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast('Request completed');
                document.getElementById("update-form").reset();
                await getList();
            }
            else{
                errorToast("Request fail !")
            }


        }
    }
</script>

