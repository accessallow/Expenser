
    <table 
        class="table table-hover table-striped table-bordered"
        id="mytable">

        <thead style="font-size: 0.8em;">
            <tr>
                <td>Bill id</td>
                <td>Amount</td>
                <td>Comment</td>
                <td>Date</td>
                <td>Type</td>
                <td class="noprint">Action</td>
            </tr>
        </thead>
    
        <tbody>
            <?php foreach ($bills as $b) { ?>
                <tr>

                    <td><?php echo $b->id; ?></td>
                    <td><?php echo $b->amount; ?></td>
                    <td><?php echo $b->comment; ?></td>
                    <td><?php echo $b->date; ?></td>
                    <td><?php echo $type_array[$b->tag]; ?></td>
                    <td class="noprint">
                        <a href="<?php echo site_url('Expense/update/' . $b->id); ?>" class="btn btn-primary btn-xs">Edit</a>
                        <a href="<?php echo site_url('Expense/delete/' . $b->id); ?>" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>