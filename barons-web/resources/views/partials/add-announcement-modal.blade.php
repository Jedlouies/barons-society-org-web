<!-- Add Announcement Modal Partial -->
<div class="modal-backdrop" id="announcementModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Add New Announcement</h3>
            <button type="button" class="close-modal-btn" onclick="closeAnnouncementModal()">&times;</button>
        </div>

        <form id="announcementForm" action="{{ route('announcements.store') }}" method="POST" onsubmit="handleAnnouncementSubmit(event)">
            @csrf
            
            <div class="form-group">
                <label for="announcement_title">Title</label>
                <input type="text" name="title" id="announcement_title" placeholder="Enter announcement title" required>
            </div>

            <div class="form-group">
                <label for="announcement_type">Type / Priority</label>
                <select name="type" id="announcement_type" required>
                    <option value="general" selected>General Notice</option>
                    <option value="urgent">Urgent Notice</option>
                </select>
            </div>

            <div class="form-group">
                <label for="announcement_expires_at">Deadline / Expiration Date & Time</label>
                <input type="datetime-local" name="expires_at" id="announcement_expires_at">
            </div>

            <div class="form-group">
                <label for="announcement_content">Content</label>
                <textarea name="content" id="announcement_content" rows="4" placeholder="Enter announcement details..." required></textarea>
            </div>

            <button type="submit" id="submitAnnouncementBtn" class="modal-submit-btn">
                <span class="btn-spinner" id="btnSpinner" style="display: none;"></span>
                <span id="btnText">Publish Announcement</span>
            </button>
        </form>
    </div>
</div>

<style>
/* Spinner CSS */
.btn-spinner {
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: #111; /* Matches button text color */
    animation: spin 0.8s linear infinite;
    display: inline-block;
    vertical-align: middle;
    margin-right: 8px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.modal-submit-btn:disabled {
    opacity: 0.75;
    cursor: not-allowed;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<script>
    function openAnnouncementModal() {
        const modal = document.getElementById('announcementModal');
        if (modal) modal.classList.add('active');
    }

    function closeAnnouncementModal() {
        const modal = document.getElementById('announcementModal');
        if (modal) modal.classList.remove('active');
    }

    function handleAnnouncementSubmit(e) {
        const btn = document.getElementById('submitAnnouncementBtn');
        const spinner = document.getElementById('btnSpinner');
        const btnText = document.getElementById('btnText');

        // Show spinner & disable button
        if (btn && spinner && btnText) {
            btn.disabled = true;
            spinner.style.display = 'inline-block';
            btnText.textContent = 'Publishing...';
        }
    }

    document.addEventListener('click', function(event) {
        const modal = document.getElementById('announcementModal');
        if (event.target === modal) closeAnnouncementModal();
    });
</script>