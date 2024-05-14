<div class="sidebar__copy">
    <span class="sidebar__copyright">
        <i class="icon icon--xsml icon--copyright"></i>
        <span class="sidebar__copytext">© Copyright <?= date('Y') ?></span>
        <span class="sidebar__copydash">PayMe.Limo</span>
    </span>
</div>

</div>
</div>
</div>
<div class="fwcim-container"></div>
<div>
    <div class="notification-wrapper pull"></div>
</div>
<div>
    <div class="notification-wrapper pull"></div>
</div>
<div class="ReactModalPortal"></div>
<div class="ReactModalPortal"></div>

<script>
    new DataTable('#example', {
        order: [
            [0, 'desc']
        ],
        "language": {
            "searchPlaceholder": "start typing.." // Placeholder text
        }
        // responsive: true
    });

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

</body>

</html>