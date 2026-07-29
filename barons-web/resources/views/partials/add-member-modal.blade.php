<!-- Include Cropper.js Styles and Script -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<!-- Add Member Modal Partial -->
<div class="modal-backdrop @if($errors->has('member_error')) active @endif" id="memberModal">
    <div class="modal-box" style="max-width: 700px; max-height: 90vh; overflow-y: auto;">
        <div class="modal-header">
            <h3>Add New Member</h3>
            <button type="button" class="close-modal-btn" onclick="closeMemberModal()">&times;</button>
        </div>

        @if($errors->has('member_error'))
            <div class="alert-error" style="display: block; margin-bottom: 16px; background-color: #fee2e2; color: #dc2626; padding: 12px; border-radius: 8px;">
                {{ $errors->first('member_error') }}
            </div>
        @endif

        <form id="memberForm" action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data" onsubmit="handleMemberSubmit(event)">
            @csrf
            
            <!-- Class Selection & Cadet Role -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="member_class_id">Select Class / Batch *</label>
                    <select name="class_id" id="member_class_id">
                        <option value="">-- No Class Assigned --</option>
                        @foreach($classes as $classItem)
                            <option value="{{ $classItem['id'] }}" {{ old('class_id') == $classItem['id'] ? 'selected' : '' }}>
                                {{ $classItem['class_name'] }} 
                                @if(!empty($classItem['batch_year'])) ({{ $classItem['batch_year'] }}) @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="member_cadet_role">Cadet Role / Position *</label>
                    <select name="cadet_role" id="member_cadet_role">
                        <option value="Corps Commander" {{ old('cadet_role') === 'Corps Commander' ? 'selected' : '' }}>Corps Commander</option>
                        <option value="Executive Officer" {{ old('cadet_role') === 'Executive Officer' ? 'selected' : '' }}>Executive Officer</option>
                        <option value="S1" {{ old('cadet_role') === 'S1' ? 'selected' : '' }}>S1 (Administrative)</option>
                        <option value="S2" {{ old('cadet_role') === 'S2' ? 'selected' : '' }}>S2 (Intelligence)</option>
                        <option value="S3" {{ old('cadet_role') === 'S3' ? 'selected' : '' }}>S3 (Operations & Training)</option>
                        <option value="S4" {{ old('cadet_role') === 'S4' ? 'selected' : '' }}>S4 (Supply & Logistics)</option>
                        <option value="S7" {{ old('cadet_role') === 'S7' ? 'selected' : '' }}>S7 (Civil-Military Operations)</option>
                        <option value="Members" {{ old('cadet_role', 'Members') === 'Members' ? 'selected' : '' }}>Members</option>
                    </select>
                </div>
            </div>

            <!-- Profile Photo Upload with Crop Preview -->
            <div class="form-group">
                <label for="member_profile_photo">Profile Photo</label>
                <input type="file" id="member_profile_photo" accept="image/jpeg,image/png,image/webp" onchange="previewAndCropImage(event)">
                
                <!-- Hidden input carrying cropped file -->
                <input type="file" name="profile_photo" id="cropped_profile_photo" style="display: none;">

                <!-- Crop Preview Container -->
                <div id="cropContainer" style="display: none; margin-top: 12px; max-width: 100%; max-height: 350px;">
                    <img id="cropImagePreview" src="" style="max-width: 100%; display: block;">
                </div>
            </div>

            <!-- Personal Info -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="member_first_name">First Name *</label>
                    <input type="text" name="first_name" id="member_first_name" value="{{ old('first_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="member_middle_name">Middle Name</label>
                    <input type="text" name="middle_name" id="member_middle_name" value="{{ old('middle_name') }}">
                </div>
                <div class="form-group">
                    <label for="member_last_name">Last Name *</label>
                    <input type="text" name="last_name" id="member_last_name" value="{{ old('last_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="member_suffix">Suffix</label>
                    <input type="text" name="suffix" id="member_suffix" placeholder="Jr., Sr., III" value="{{ old('suffix') }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="member_nickname">Nickname</label>
                    <input type="text" name="nickname" id="member_nickname" value="{{ old('nickname') }}">
                </div>
                <div class="form-group">
                    <label for="member_gender">Gender</label>
                    <select name="gender" id="member_gender">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="member_birth_date">Birth Date</label>
                    <input type="date" name="birth_date" id="member_birth_date" value="{{ old('birth_date') }}">
                </div>
            </div>

            <!-- Contact & Civil Status -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="member_email">Email *</label>
                    <input type="email" name="email" id="member_email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="member_contact_number">Contact Number</label>
                    <input type="text" name="contact_number" id="member_contact_number" value="{{ old('contact_number') }}">
                </div>
                <div class="form-group">
                    <label for="member_civil_status">Civil Status</label>
                    <select name="civil_status" id="member_civil_status">
                        <option value="">Select Status</option>
                        <option value="Single" {{ old('civil_status') === 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('civil_status') === 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Widowed" {{ old('civil_status') === 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                </div>
            </div>

            <!-- Address Fields -->
            <div class="form-group">
                <label for="member_address">Address</label>
                <input type="text" name="address" id="member_address" value="{{ old('address') }}">
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="member_city">City</label>
                    <input type="text" name="city" id="member_city" value="{{ old('city') }}">
                </div>
                <div class="form-group">
                    <label for="member_province">Province</label>
                    <input type="text" name="province" id="member_province" value="{{ old('province') }}">
                </div>
                <div class="form-group">
                    <label for="member_country">Country</label>
                    <input type="text" name="country" id="member_country" value="{{ old('country', 'Philippines') }}">
                </div>
            </div>

            <!-- Employment, Company & Business Name -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="member_occupation">Occupation</label>
                    <input type="text" name="occupation" id="member_occupation" value="{{ old('occupation') }}">
                </div>
                <div class="form-group">
                    <label for="member_company">Company</label>
                    <input type="text" name="company" id="member_company" value="{{ old('company') }}">
                </div>
                <div class="form-group">
                    <label for="member_business_name">Business Name</label>
                    <input type="text" name="business_name" id="member_business_name" value="{{ old('business_name') }}">
                </div>
            </div>

            <!-- Social Media Field -->
            <div class="form-group">
                <label for="member_facebook_url">Facebook Profile URL</label>
                <input type="url" name="facebook_url" id="member_facebook_url" placeholder="https://facebook.com/username" value="{{ old('facebook_url') }}">
            </div>

            <button type="submit" id="submitMemberBtn" class="modal-submit-btn">
                <span class="btn-spinner" id="memberBtnSpinner" style="display: none;"></span>
                <span id="memberBtnText">Add Member</span>
            </button>
        </form>
    </div>
</div>

<script>
    let cropper = null;

    function openMemberModal() {
        const modal = document.getElementById('memberModal');
        if (modal) modal.classList.add('active');
    }

    function closeMemberModal() {
        const modal = document.getElementById('memberModal');
        if (modal) modal.classList.remove('active');
        resetCropper();
    }

    function resetCropper() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        document.getElementById('cropContainer').style.display = 'none';
        document.getElementById('cropImagePreview').src = '';
    }

    function previewAndCropImage(event) {
        const files = event.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const image = document.getElementById('cropImagePreview');
                image.src = e.target.result;
                document.getElementById('cropContainer').style.display = 'block';

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                });
            };

            reader.readAsDataURL(file);
        }
    }

    function handleMemberSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById('submitMemberBtn');
        const spinner = document.getElementById('memberBtnSpinner');
        const btnText = document.getElementById('memberBtnText');

        const showLoading = () => {
            if (btn && spinner && btnText) {
                btn.style.pointerEvents = 'none';
                spinner.style.display = 'inline-block';
                btnText.textContent = 'Saving...';
            }
        };

        if (cropper) {
            cropper.getCroppedCanvas({
                width: 500,
                height: 500,
            }).toBlob((blob) => {
                if (!blob) {
                    showLoading();
                    HTMLFormElement.prototype.submit.call(form);
                    return;
                }

                const fileInput = document.getElementById('cropped_profile_photo');
                const croppedFile = new File([blob], 'profile_photo.jpg', { type: 'image/jpeg' });
                
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                fileInput.files = dataTransfer.files;

                showLoading();

                HTMLFormElement.prototype.submit.call(form);
            }, 'image/jpeg', 0.9);
        } else {
            showLoading();
            HTMLFormElement.prototype.submit.call(form);
        }
    }

    document.addEventListener('click', function(event) {
        const modal = document.getElementById('memberModal');
        if (event.target === modal) closeMemberModal();
    });
</script>