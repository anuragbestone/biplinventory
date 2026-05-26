            <div class="footer-inventory">@ {{ date("Y") }} Bestone Inventory Systems. All Rights Reserved.</div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.ripples/0.5.3/jquery.ripples.min.js"></script>
        <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
        <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
    Swal.fire({
        text: @json(session('success')),
        icon: "success"
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        text: @json(session('error')),
        icon: "error"
    });
</script>
@endif
<script>
    document.addEventListener("submit", function (e) {
        const form = e.target;
        // Only target forms having this class
        if (!form.classList.contains("generalformloader")) {
            return;
        }

        // Skip loader condition
        if (form.dataset.skipLoader === "true") {
            return;
        }
        const loader = document.getElementById("pageLoader");
        if (loader) {
            // Show loader
            loader.style.display = "flex";
            // Freeze screen scroll
            document.body.style.overflow = "hidden";
            // Prevent clicking entire screen
            document.body.style.pointerEvents = "none";
            // Allow loader interaction
            loader.style.pointerEvents = "all";
        }
    });
    document.addEventListener("keydown", function(e)
        {
            // CHECK ENTER KEY
            if(e.key === "Enter")
            {
                // CURRENT ELEMENT
                let element = document.activeElement;

                // ALLOW TEXTAREA ENTER
                if(element.tagName === "TEXTAREA")
                {
                    return;
                }

                // PREVENT FORM SUBMIT
                e.preventDefault();

                // GET ALL FOCUSABLE ELEMENTS
                let focusable = Array.from(
                    document.querySelectorAll(
                        'input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled])'
                    )
                ).filter(el => el.offsetParent !== null);

                // CURRENT INDEX
                let index = focusable.indexOf(element);

                // NEXT ELEMENT
                let nextElement = focusable[index + 1];

                // MOVE FOCUS
                if(nextElement)
                {
                    nextElement.focus();
                }
            }
        });
</script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<!-- DataTables Bootstrap 5 -->
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    </body>    
</html>