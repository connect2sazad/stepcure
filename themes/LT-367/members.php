<div class="container">
    <h1 class="py-3">Members</h1>
    <div class="row my-4">
        <div class="col-4 border-right">

            <?php

            $online_user_id = onlineUserVariable('id');
            $members = getMembersByOnlineUser($online_user_id);

            if (!$members || mysqli_num_rows($members) == 0) {
                echo '<p>No members found.</p>';
            } else {


                while ($member = mysqli_fetch_assoc($members)) {
                    $member_id = $member['id'];
                    $member_name = $member['first_name'];
                    echo '
                <div class="card w-100 mb-3">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($member_name) . '</h5>
                        <a href="index.php?page=member&member_id=' . urlencode($member_id) . '" class="btn btn-primary">View Member</a>
                    </div>
                </div>
                ';
                }
            }

            ?>

            <div class="card w-100 mb-3">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
            <div class="card w-100 mb-3">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
        </div>
        <div class="col-8 pl-4">
            <!-- <h1>sdfsd</h1> -->
            <p>No member selected!!</p>
        </div>
    </div>
</div>