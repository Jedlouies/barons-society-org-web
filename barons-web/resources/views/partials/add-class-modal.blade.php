<!-- Include Cropper.js Styles and Script -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<!-- Add Class Modal Partial -->
<div class="modal-backdrop @if($errors->has('class_error')) active @endif" id="classModal">
    <div class="modal-box" style="max-width: 600px; max-height: 90vh; overflow-y: auto;">
        <div class="modal-header">
            <h3>Add New Class</h3>
            <button type="button" class="close-modal-btn" onclick="closeClassModal()">&times;</button>
        </div>

        @if($errors->has('class_error'))
            <div class="alert-error" style="display: block; margin-bottom: 16px;">
                {{ $errors->first('class_error') }}
            </div>
        @endif

        <form id="classForm" action="{{ route('classes.store') }}" method="POST" enctype="multipart/form-data" onsubmit="handleClassSubmit(event)">
            @csrf

            <!-- Class Name & Number -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="class_name">Class Name *</label>
                    <input type="text" name="class_name" id="class_name" placeholder="e.g. Masidlak" required>
                </div>
                <div class="form-group">
                    <label for="class_number">Class Number</label>
                    <input type="number" name="class_number" id="class_number" placeholder="e.g. 1" min="1">
                </div>
            </div>

            <!-- Batch Year & Corps Commander -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="batch_year">Batch Year</label>
                    <input type="number" name="batch_year" id="batch_year" placeholder="e.g. 2024" min="1950" max="2100">
                </div>
                <div class="form-group">
                    <label for="corps_commander">Corps Commander</label>
                    <input type="text" name="corps_commander" id="corps_commander" placeholder="e.g. C/COL Juan Dela Cruz">
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="class_description">Description</label>
                <textarea name="description" id="class_description" rows="3" placeholder="Enter optional class history or motto..."></textarea>
            </div>

            <!-- Class Logo Upload -->
            <div class="form-group">
                <label for="class_logo_input">Class Logo (Optional)</label>
                <input type="file" id="class_logo_input" accept="image/jpeg,image/png,image/webp" onchange="previewAndCropClassLogo(event)">
                
                <!-- Hidden input carrying cropped binary file -->
                <input type="file" name="class_logo" id="cropped_class_logo" style="display: none;">

                <!-- Crop Preview Container -->
                <div id="classLogoCropContainer" style="display: none; margin-top: 12px; max-width: 100%; max-height: 300px;">
                    <img id="classLogoPreview" src="" style="max-width: 100%; display: block;">
                </div>
            </div>

            <button type="submit" id="submitClassBtn" class="modal-submit-btn">
                <span class="btn-spinner" id="classBtnSpinner" style="display: none;"></span>
                <span id="classBtnText">Save Class</span>
            </button>
        </form>
    </div>
</div>

<script>
    let classCropper = null;

    function openClassModal() {
        const modal = document.getElementById('classModal');
        if (modal) modal.classList.add('active');
    }

    function closeClassModal() {
        const modal = document.getElementById('classModal');
        if (modal) modal.classList.remove('active');
        resetClassCropper();
    }

    function resetClassCropper() {
        if (classCropper) {
            classCropper.destroy();
            classCropper = null;
        }
        document.getElementById('classLogoCropContainer').style.display = 'none';
        document.getElementById('classLogoPreview').src = '';
    }

    function previewAndCropClassLogo(event) {
        const files = event.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const image = document.getElementById('classLogoPreview');
                image.src = e.target.result;
                document.getElementById('classLogoCropContainer').style.display = 'block';

                if (classCropper) {
                    classCropper.destroy();
                }

                // 1:1 Aspect Ratio Cropper
                classCropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                });
            };

            reader.readAsDataURL(file);
        }
    }

    function handleClassSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById('submitClassBtn');
        const spinner = document.getElementById('classBtnSpinner');
        const btnText = document.getElementById('classBtnText');

        if (classCropper) {
            classCropper.getCroppedCanvas({
                width: 500,
                height: 500,
            }).toBlob((blob) => {
                const fileInput = document.getElementById('cropped_class_logo');
                const croppedFile = new File([blob], 'class_logo.jpg', { type: 'image/jpeg' });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                fileInput.files = dataTransfer.files;

                if (btn && spinner && btnText) {
                    btn.disabled = true;
                    spinner.style.display = 'inline-block';
                    btnText.textContent = 'Saving Class...';
                }

                form.submit();
            }, 'image/jpeg', 0.9);
        } else {
            if (btn && spinner && btnText) {
                btn.disabled = true;
                spinner.style.display = 'inline-block';
                btnText.textContent = 'Saving Class...';
            }
            form.submit();
        }
    }

    document.addEventListener('click', function(event) {
        const modal = document.getElementById('classModal');
        if (event.target === modal) closeClassModal();
    });
</script>