<?php
    session_start();
    include 'inc/red_auth.php';
    echo $headerContent = "Books Stocks";
    include 'inc/user_head.php';
    ?>
    <table id="booksTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Languages</th>
                <th>Quantity</th>
                <!-- <th>Cover Image</th> -->
            </tr>
        </thead>
        <tbody></tbody>
    </table>
<?php  include 'inc/links.php'; ?>
    <script>
    $(document).ready(function() {
        $('#booksTable').DataTable({
            ajax: {
                url: 'stock_fetch_books.php', // URL to fetch data from
                dataSrc: '' // Data source as an empty string since the JSON response is an array
            },
            columns: [
                { data: 'id' },
                { data: 'title' },
                { data: 'author' },
                { data: 'publisher' },
                { data: 'languages' },
                { data: 'quantity' },
                // { 
                //     data: 'cover_image',
                //     render: function(data) {
                //         return '<img src="' + data + '" width="100">';
                //     }
                // }
            ]
        });
    });
    </script>
</body>
</html>
