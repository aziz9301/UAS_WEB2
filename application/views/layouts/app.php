<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/summernote/dist/summernote-bs4.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<title>GAMEBEL- <?= $title ?></title>
</head>

<body>


	<!-- Navbar -->
	<?php $this->load->view('layouts/_navbar') ?>
	<!-- End of Navbar -->

	<!-- Content -->
	<?php $this->load->view($page) ?>
	<!-- End for Content -->


	<script src="<?= base_url() ?>/assets/vendors/jquery/jquery.min.js"></script>
	<script src="<?= base_url() ?>/assets/vendors/popper/popper.min.js"></script>
	<script src="<?= base_url() ?>/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>/assets/vendors/summernote/dist/summernote.min.js"></script>
	<script src="<?= base_url() ?>/assets/plugins/toastr/toastr.min.js"></script>
	<script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script>
		$('#summernote').summernote({
			height: 300,
		});
		$('#summernote2').summernote({
			height: 300,
		});
		$(function(){
			var flash=$('#flash').data('flash');
		})
		if(flash){
			$('.toastrDefaultSuccess').click(function(){
				toastr.success({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					text:'Succes Add to Cart'
				})
			})
		}
		$(function() {
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});

			$('.swalDefaultSuccess').click(function() {
				Toast.fire({
					icon: 'success',
					title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.swalDefaultInfo').click(function() {
				Toast.fire({
					icon: 'info',
					title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.swalDefaultError').click(function() {
				Toast.fire({
					icon: 'error',
					title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.swalDefaultWarning').click(function() {
				Toast.fire({
					icon: 'warning',
					title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.swalDefaultQuestion').click(function() {
				Toast.fire({
					icon: 'question',
					title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});

			$('.toastrDefaultSuccess').click(function() {
				toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
			});
			$('.toastrDefaultInfo').click(function() {
				toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
			});
			$('.toastrDefaultError').click(function() {
				toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
			});
			$('.toastrDefaultWarning').click(function() {
				toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
			});

			$('.toastsDefaultDefault').click(function() {
				$(document).Toasts('create', {
					title: 'Toast Title',
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.toastsDefaultTopLeft').click(function() {
				$(document).Toasts('create', {
					title: 'Toast Title',
					position: 'topLeft',
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.toastsDefaultBottomRight').click(function() {
				$(document).Toasts('create', {
					title: 'Toast Title',
					position: 'bottomRight',
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.toastsDefaultBottomLeft').click(function() {
				$(document).Toasts('create', {
					title: 'Toast Title',
					position: 'bottomLeft',
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.toastsDefaultAutohide').click(function() {
				$(document).Toasts('create', {
					title: 'Toast Title',
					autohide: true,
					delay: 750,
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.toastsDefaultNotFixed').click(function() {
				$(document).Toasts('create', {
					title: 'Toast Title',
					fixed: false,
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.toastsDefaultFull').click(function() {
				$(document).Toasts('create', {
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
					title: 'Toast Title',
					subtitle: 'Subtitle',
					icon: 'fas fa-envelope fa-lg',
				})
			});
			$('.toastsDefaultFullImage').click(function() {
				$(document).Toasts('create', {
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
					title: 'Toast Title',
					subtitle: 'Subtitle',
					image: '../../dist/img/user3-128x128.jpg',
					imageAlt: 'User Picture',
				})
			});
			$('.toastsDefaultSuccess').click(function() {
				$(document).Toasts('create', {
					class: 'bg-success',
					title: 'Toast Title',
					subtitle: 'Subtitle',
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.toastsDefaultInfo').click(function() {
				$(document).Toasts('create', {
					class: 'bg-info',
					title: 'Toast Title',
					subtitle: 'Subtitle',
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.toastsDefaultWarning').click(function() {
				$(document).Toasts('create', {
					class: 'bg-warning',
					title: 'Toast Title',
					subtitle: 'Subtitle',
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.toastsDefaultDanger').click(function() {
				$(document).Toasts('create', {
					class: 'bg-danger',
					title: 'Toast Title',
					subtitle: 'Subtitle',
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
			$('.toastsDefaultMaroon').click(function() {
				$(document).Toasts('create', {
					class: 'bg-maroon',
					title: 'Toast Title',
					subtitle: 'Subtitle',
					body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
				})
			});
		});
	</script>

</body>

</html>