<!-- Include Cropper.js Styles and Script -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<div class="modal-backdrop @if($errors->has('news_error')) active @endif" id="newsModal">
    <!-- Landscape Modal Box -->
    <div class="modal-box landscape-modal">
        <div class="modal-header">
            <h3>Add News & Article Update</h3>
            <button type="button" class="close-modal-btn" onclick="closeNewsModal()">&times;</button>
        </div>

        @if($errors->has('news_error'))
            <div class="alert-error">
                {{ $errors->first('news_error') }}
            </div>
        @endif

        <!-- Wizard Progress Step Bar -->
        <div class="wizard-progress">
            <div class="wizard-step active" id="newsStepIndicator1">
                <span class="step-num">1</span>
                <span class="step-title">Article Details</span>
            </div>
            <div class="wizard-step" id="newsStepIndicator2">
                <span class="step-num">2</span>
                <span class="step-title">Article Content</span>
            </div>
            <div class="wizard-step" id="newsStepIndicator3">
                <span class="step-num">3</span>
                <span class="step-title">Cover Image</span>
            </div>
        </div>

        <form id="newsForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" onsubmit="handleNewsSubmit(event)">
            @csrf

            <!-- SECTION 1: Article Header Details -->
            <div class="wizard-section active" id="newsWizardSection1">
                <div class="form-group">
                    <label for="news_title">Article Title *</label>
                    <input type="text" name="title" id="news_title" placeholder="e.g. 36th Anniversary Celebration" value="{{ old('title') }}" required>
                </div>

                <div class="landscape-grid-2" style="align-items: center;">
                    <div class="form-group">
                        <label for="published_date">Published Date *</label>
                        <input type="date" name="published_date" id="published_date" value="{{ old('published_date', date('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group" style="display: flex; align-items: center; gap: 8px; margin-top: 16px;">
                        <input type="checkbox" name="featured" id="news_featured" value="1" {{ old('featured') ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                        <label for="news_featured" style="cursor: pointer; margin-bottom: 0;">Mark as Featured Article</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="news_summary">Summary / Excerpt</label>
                    <textarea name="summary" id="news_summary" rows="2" placeholder="Brief summary of the news article...">{{ old('summary') }}</textarea>
                </div>
            </div>

            <!-- SECTION 2: Article Content -->
            <div class="wizard-section" id="newsWizardSection2">
                <div class="form-group">
                    <label for="news_content">Content *</label>
                    <textarea name="content" id="news_content" rows="8" placeholder="Write full article details here..." required>{{ old('content') }}</textarea>
                </div>
            </div>

            <!-- SECTION 3: Cover Image Upload & Cropping -->
            <div class="wizard-section" id="newsWizardSection3">
                <div class="form-group">
                    <label for="news_cover_input">Cover Image (Optional - 16:9 Aspect Ratio)</label>
                    <input type="file" id="news_cover_input" accept="image/jpeg,image/png,image/webp" onchange="previewAndCropNewsImage(event)">
                    
                    <input type="file" name="cover_image" id="cropped_news_cover" style="display: none;">

                    <div id="newsCropContainer" style="display: none; margin-top: 12px; max-width: 100%; max-height: 280px;">
                        <img id="newsCropPreview" src="" style="max-width: 100%; display: block;">
                    </div>
                </div>
            </div>

            <!-- Wizard Controls Footer -->
            <div class="wizard-controls">
                <button type="button" class="wizard-btn btn-prev" id="prevNewsWizardBtn" onclick="navigateNewsWizard(-1)" style="display: none;">
                    ← Previous
                </button>
                <button type="button" class="wizard-btn btn-next" id="nextNewsWizardBtn" onclick="navigateNewsWizard(1)">
                    Next Step →
                </button>
                <button type="submit" id="submitNewsBtn" class="modal-submit-btn" style="display: none; width: auto; padding: 10px 24px;">
                    <span class="btn-spinner" id="newsBtnSpinner" style="display: none;"></span>
                    <span id="newsBtnText">Publish Article</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Landscape Wizard Modal Styling */
.landscape-modal {
    max-width: 900px !important;
    width: 95%;
    max-height: 90vh;
    overflow-y: auto;
    padding: 24px;
}

.landscape-grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.alert-error {
    display: block;
    margin-bottom: 16px;
    background-color: #fee2e2;
    color: #dc2626;
    padding: 12px;
    border-radius: 8px;
}

/* Wizard Header Progress Bar */
.wizard-progress {
    display: flex;
    justify-content: space-between;
    margin-bottom: 24px;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 12px;
}

.wizard-step {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #94a3b8;
    font-size: 13px;
    font-weight: 600;
}

.wizard-step .step-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #e2e8f0;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
}

.wizard-step.active {
    color: #0f172a;
}

.wizard-step.active .step-num {
    background: #0f172a;
    color: #ffffff;
}

.wizard-step.completed {
    color: #16a34a;
}

.wizard-step.completed .step-num {
    background: #dcfce7;
    color: #16a34a;
}

/* Wizard Step Visibility */
.wizard-section {
    display: none;
}

.wizard-section.active {
    display: block;
}

/* Wizard Control Buttons */
.wizard-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    padding-top: 16px;
    border-top: 1px solid #e2e8f0;
}

.wizard-btn {
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.2s ease;
}

.btn-prev {
    background: #f1f5f9;
    color: #475569;
}

.btn-prev:hover {
    background: #e2e8f0;
}

.btn-next {
    background: #0f172a;
    color: #ffffff;
    margin-left: auto;
}

.btn-next:hover {
    background: #1e293b;
}

@media (max-width: 768px) {
    .landscape-grid-2 {
        grid-template-columns: 1fr;
    }
    .wizard-step .step-title {
        display: none;
    }
}
</style>

<script>
    let newsCropper = null;
    let currentNewsStep = 1;
    const totalNewsSteps = 3;

    function openNewsModal() {
        const modal = document.getElementById('newsModal');
        if (modal) {
            modal.classList.add('active');
            currentNewsStep = 1;
            updateNewsWizardView();
        }
    }

    function closeNewsModal() {
        const modal = document.getElementById('newsModal');
        if (modal) modal.classList.remove('active');
        resetNewsCropper();
    }

    function navigateNewsWizard(direction) {
        if (direction === 1 && !validateNewsCurrentStep(currentNewsStep)) {
            return;
        }

        currentNewsStep += direction;

        if (currentNewsStep < 1) currentNewsStep = 1;
        if (currentNewsStep > totalNewsSteps) currentNewsStep = totalNewsSteps;

        updateNewsWizardView();
    }

    function validateNewsCurrentStep(step) {
        const currentSection = document.getElementById(`newsWizardSection${step}`);
        if (!currentSection) return true;

        const requiredInputs = currentSection.querySelectorAll('[required]');
        let isValid = true;

        requiredInputs.forEach((input) => {
            if (!input.checkValidity()) {
                input.reportValidity();
                isValid = false;
            }
        });

        return isValid;
    }

    function updateNewsWizardView() {
        for (let i = 1; i <= totalNewsSteps; i++) {
            const section = document.getElementById(`newsWizardSection${i}`);
            const indicator = document.getElementById(`newsStepIndicator${i}`);

            if (section) {
                section.classList.toggle('active', i === currentNewsStep);
            }

            if (indicator) {
                indicator.classList.remove('active', 'completed');
                if (i === currentNewsStep) {
                    indicator.classList.add('active');
                } else if (i < currentNewsStep) {
                    indicator.classList.add('completed');
                }
            }
        }

        const prevBtn = document.getElementById('prevNewsWizardBtn');
        const nextBtn = document.getElementById('nextNewsWizardBtn');
        const submitBtn = document.getElementById('submitNewsBtn');

        if (prevBtn) prevBtn.style.display = (currentNewsStep === 1) ? 'none' : 'inline-block';
        if (nextBtn) nextBtn.style.display = (currentNewsStep === totalNewsSteps) ? 'none' : 'inline-block';
        if (submitBtn) submitBtn.style.display = (currentNewsStep === totalNewsSteps) ? 'inline-block' : 'none';
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

        const showLoading = () => {
            if (btn && spinner && btnText) {
                btn.style.pointerEvents = 'none'; 
                spinner.style.display = 'inline-block';
                btnText.textContent = 'Publishing...';
            }
        };

        if (newsCropper) {
            newsCropper.getCroppedCanvas({
                width: 1280,
                height: 720,
            }).toBlob((blob) => {
                if (!blob) {
                    showLoading();
                    HTMLFormElement.prototype.submit.call(form);
                    return;
                }

                const croppedFile = new File([blob], 'cover_image.jpg', { type: 'image/jpeg' });
                const fileInput = document.getElementById('cropped_news_cover');

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                fileInput.files = dataTransfer.files;

                showLoading();

                HTMLFormElement.prototype.submit.call(form);
            }, 'image/jpeg', 0.85);
        } else {
            showLoading();
            HTMLFormElement.prototype.submit.call(form);
        }
    }

    document.addEventListener('click', function(event) {
        const modal = document.getElementById('newsModal');
        if (event.target === modal) closeNewsModal();
    });
</script>