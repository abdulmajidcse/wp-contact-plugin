<div class="all-contact container mt-2">
    <h4 class="text-dark">All Contact</h4>
    <div class="table-responsive">
        <table class="all-contact table table-hover">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Subject</td>
                    <td>Message</td>
                    <td>Action</td>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                <?php foreach ( $all_contact as $contact ) { ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td class="text-primary" style="cursor: pointer;"><?php echo $contact->name; ?></td>
                        <td><?php echo $contact->email; ?></td>
                        <td><?php echo $contact->subject; ?></td>
                        <td><?php echo $contact->message; ?></td>
                        <td><a onclick="return confirm('Are you sure?')" href="javascript:void(0)" class="btn btn-sm btn-outline-danger">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>