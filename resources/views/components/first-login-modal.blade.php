<div>
    @if ($showModal)
        <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog"
            aria-labelledby="firstTimeLoggedInModalLabel" aria-hidden="true" id="firstTimeLoggedInModal">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="firstTimeLoggedInModalLabel">Welcome to WRATS!</h1>
                        <button type="button" class="btn-close" onclick="closeModal()"></button>
                    </div>
                    <div class="modal-body">
                        <p>To get a quick tour of WRATS, please read our <a href="{{ url('/knowledge-base/doku.php?id=quick_start') }}" target="_blank" class="link-primary">Quick Start guide</a>.</p>
                        <p>For a deeper dive, navigate to the <a href="{{ url('/knowledge-base/doku.php?id=start') }}" target="_blank" class="link-primary">Knowledge Base</a>.</p>
                        <small>You can also navigate to the Knowledge Base by clicking the top right avatar circle and selecting ‘Knowledge Base’.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show" id="modalBackdrop"></div>
    @endif
</div>

<script>
    function closeModal() {
        document.getElementById('firstTimeLoggedInModal').style.display = 'none';
        document.getElementById('modalBackdrop').style.display = 'none'; // Hide the backdrop
    }
</script>
