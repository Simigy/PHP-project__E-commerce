<!-- jQuery -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Additional Scripts -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/owl.js') }}"></script>
<script src="{{ asset('assets/js/slick.js') }}"></script>
<script src="{{ asset('assets/js/isotope.js') }}"></script>
<script src="{{ asset('assets/js/accordions.js') }}"></script>

<script>
    var cleared = [0, 0, 0]; //set a cleared flag for each field
    function clearField(t) {
        if (!cleared[t.id]) {
            cleared[t.id] = 1;
            t.value = '';
            t.style.color = '#fff';
        }
    }
</script>