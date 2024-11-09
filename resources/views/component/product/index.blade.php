<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Product</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0  bg-info text-light fs-5">Create</button>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>Id</th>
                    <th>Product Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script>
    getList()
async function getList(){
    $('#tableList').empty();
    let res = await axios.get('/product-list');
    res.data.forEach(function(item,index){
        let row = `<tr>
            <td>${index+1}</td>
            <td>${item['product_id']}</td>
            <td>${item['name']}</td>
            <td>${item['description']}</td>
            <td>${item['price']}</td>
            <td>${item['stock']}</td>
            <td><img class="w-80 h-80 h-auto" alt="" src="${item['img']}"></td>
            <td>
                <button data-path="${item['img']}" data-id="${item['product_id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                <button data-path="${item['img']}" data-id="${item['product_id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
            </td>
        </tr>`
        $('#tableList').append(row);
    })

    $('.deleteBtn').on('click',function () {
        let id= $(this).data('id');
        let path= $(this).data('path');

        $("#delete-modal").modal('show');
        $("#deleteID").val(id);
        $("#deleteFilePath").val(path)
    })

    $('.editBtn').on('click',async function () {
        let filePath= $(this).data('path');
        let product_id= $(this).data('id');
        await FillUpUpdateForm(filePath,product_id)
        $("#update-modal").modal('show');

    })

    new DataTable('#tableData',{
        order:[[0,'asc']],
        lengthMenu:[5,10,15,20,30],
    });
}



</script>



