<script>
    const $toDownElement = document.querySelectorAll(".toDown")
    const $toLeftElement = document.querySelectorAll(".toLeft")
    var slideUp = {
        distance: '20%',
        scale: .98,
        interval:50,
        origin: 'bottom',
        duration: 500,
        opacity: 0
    };
    ScrollReveal({reset: false}).reveal($toLeftElement, {...slideUp,origin:"left",duration:300,interval:0})
    ScrollReveal({reset: false}).reveal($toDownElement, slideUp);
</script>