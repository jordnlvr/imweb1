<?= view('template/header') ?>

<?= view('template/sidebar') ?>

<!-- Main -->

<div class="l--main ">
    <div id="topOfPage"><span></span>
        <div class="l--content--grid">
            <header class="header header--grid">
                <div class="header__title">Update Profile</div>
                <a href="javascript:history.back()" class="btn-sm btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back</a>
            </header>

            <div class="table-responsive">
                <form action="javascript:void(0)" method="post" name="update_profile" id="update_profile">
                    <input type="hidden" name="id" id="id" value="<?php echo $users->auth_identities ?? '' ?>">
                    <div class="" style="max-width: 500px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="secret">Email Address <span class="require">*</span></label>
                                    <input type="email" class="form-control" id="secret" name="email" value="<?php echo $users->secret; ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Merchant Name </label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $users->name ?? '' ?>">
                                </div>
                            </div>
                        </div>
                        <div class=" border-top-0 d-flex justify-content-right">
                            <button type="submit" id="save" name="save" class="btn btn-primary">Save</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- Main -->
<?= view('template/footer') ?>

<link href="<?= base_url('public/assets/css/bootstrap.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/responsive.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/sweetalert2.min.css'); ?>" rel="stylesheet">

<script>
    new DataTable('#example', {
        // responsive: true
    });
</script>

<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>

<script>
    var id = $('#id').val();
    var url = "index.php/update-profile/" + id;
    if ($("#update_profile").length > 0) {
        $("#update_profile").validate({
            rules: {
                email: {
                    required: true,
                    maxlength: 50,
                    email: true,
                },
            },
            messages: {
                email: {
                    required: "Please enter valid email",
                    email: "Please enter valid email",
                    maxlength: "The email name should less than or equal to 50 characters",
                },

            },
            submitHandler: function(form) {
                swal({
                    title: 'Are you sure...?',
                    //text: "You want to continue...?",
                    type: 'warning',
                    showCancelButton: true,
                }).then((Delete) => {
                    if (Delete) {
                        addOverlay();
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: $('#update_profile').serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.error === true) {
                                    errors = response.message;
                                    alert(errors);
                                    return false;
                                }
                                if (response.success === true) {
                                    swal({
                                        position: "top-end",
                                        icon: "success",
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    window.location.href = url;
                                }
                            },
                            complete: removeOverlay
                        });
                        return false;
                    } else {
                        swal.close();
                    }
                });
            }
        })

    }
</script>