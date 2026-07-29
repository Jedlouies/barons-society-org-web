<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<div class="modal-backdrop @if($errors->has('news_error')) active @endif" id="newsModal">
    <div class="modal-box" style="max-width: 700px; max-height: 90vh; overflow-y: auto;">
        <div class="modal-header">
            <h3>Add News & Article Update</h3>
            <button type="button" class="close-modal-btn" onclick="closeNewsModal()">&times;</button>
        </div>

        @if($errors->has('news_error'))
            <div class="alert-error" style="display: block; margin-bottom: 16px;">
                {{ $errors->first('news_error') }}
            </div>
        @endif

        <form id="newsForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" onsubmit="handleNewsSubmit(event)">
            @csrf

            <div class="form-group">
                <label for="news_title">Article Title *</label>
                <input type="text" name="title" id="news_title" placeholder="e.g. 36th Anniversary Celebration" required>
            </div>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="published_date">Published Date *</label>
                    <input type="date" name="published_date" id="published_date" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group" style="display: flex; align-items: center; gap: 8px; margin-top: 24px;">
                    <input type="checkbox" name="featured" id="news_featured" value="1" style="width: 18px; height: 18px; cursor: pointer;">
                    <label for="news_featured" style="cursor: pointer; margin-bottom: 0;">Mark as Featured Article</label>
                </div>
            </div>

            <div class="form-group">
                <label for="news_summary">Summary / Excerpt</label>
                <textarea name="summary" id="news_summary" rows="2" placeholder="Brief summary of the news article..."></textarea>
            </div>

            <div class="form-group">
                <label for="news_content">Content *</label>
                <textarea name="content" id="news_content" rows="5" placeholder="Write full article details here..." required></textarea>
            </div>

            <div class="form-group">
                <label for="news_cover_input">Cover Image (16:9 Aspect Ratio) *</label>
                <input type="file" id="news_cover_input" accept="image/jpeg,image/png,image/webp" onchange="previewAndCropNewsImage(event)">
                
                <input type="file" name="cover_image" id="cropped_news_cover" style="display: none;">

                <div id="newsCropContainer" style="display: none; margin-top: 12px; max-width: 100%; max-height: 350px;">
                    <img id="newsCropPreview" src="" style="max-width: 100%; display: block;">
                </div>
            </div>

            <button type="submit" id="submitNewsBtn" class="modal-submit-btn">
                <span class="btn-spinner" id="newsBtnSpinner" style="display: none;"></span>
                <span id="newsBtnText">Publish Article</span>
            </button>
        </form>
    </div>
</div>

<script>
    let newsCropper = null;

    function openNewsModal() {
        const modal = document.getElementById('newsModal');
        if (modal) modal.classList.add('active');
    }

    function closeNewsModal() {
        const modal = document.getElementById('newsModal');
        if (modal) modal.classList.remove('active');
        resetNewsCropper();
    }

    function resetNewsCropper() {
        if (newsCropper) {
            newsCropper.destroy();
            newsCropper = null;
        }
        document.getElementById('newsCropContainer').style.display = 'none';
        document.getElementById('newsCropPreview').src = '';
    }

    function previewAndCropNewsImage(event) {
        const files = event.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const image = document.getElementById('newsCropPreview');
                image.src = e.target.result;
                document.getElementById('newsCropContainer').style.display = 'block';

                if (newsCropper) {
                    newsCropper.destroy();
                }

                newsCropper = new Cropper(image, {
                    aspectRatio: 16 / 9,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                });
            };

            reader.readAsDataURL(file);
        }
    }

    function handleNewsSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById('submitNewsBtn');
        const spinner = document.getElementById('newsBtnSpinner');
        const btnText = document.getElementById('newsBtnText');

        if (newsCropper) {
            newsCropper.getCroppedCanvas({
                width: 1280,
                height: 720,
            }).toBlob((blob) => {
                const fileInput = document.getElementById('cropped_news_cover');
                const croppedFile = new File([blob], 'cover_image.jpg', { type: 'image/jpeg' });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                fileInput.files = dataTransfer.files;

                if (btn && spinner && btnText) {
                    btn.disabled = true;
                    spinner.style.display = 'inline-block';
                    btnText.textContent = 'Publishing...';
                }

                form.submit();
            }, 'image/jpeg', 0.85);
        } else {
            if (btn && spinner && btnText) {
                btn.disabled = true;
                spinner.style.display = 'inline-block';
                btnText.textContent = 'Publishing...';
            }
            form.submit();
        }
    }

    document.addEventListener('click', function(event) {
        const modal = document.getElementById('newsModal');
        if (event.target === modal) closeNewsModal();
    });
</script>