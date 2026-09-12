<?php $__env->startSection('title', 'Profile · Content Studio'); ?>
<?php $__env->startSection('breadcrumb', 'Profile'); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $input =
            'mt-1 w-full rounded-lg border border-[#DDE2DF] bg-white px-3 py-2.5 text-sm outline-none transition focus:border-[#8FA58F] focus:ring-2 focus:ring-[#8FA58F]/15';
        $label = 'text-xs font-medium text-[#424843]';
    ?>
    <section class="mb-7 flex flex-col items-start justify-between gap-5 lg:flex-row lg:items-end">
        <div class="max-w-2xl">
            <span class="text-[10px] font-semibold tracking-[0.11em] text-[#526A5A]">PUBLIC PROFESSIONAL IDENTITY</span>
            <h1 class="mt-2 font-['Newsreader'] text-3xl font-medium tracking-tight text-[#293C32] sm:text-4xl">Professional
                Profile</h1>
            <p class="mt-2 text-sm leading-6 text-[#70766F]">This information powers the About page, author card, and
                professional credibility sections on the public website.</p>
        </div>
        <a href="<?php echo e(config('app.frontend_url', env('FRONTEND_URL', '#'))); ?>/about" target="_blank"
            class="inline-flex h-10 items-center rounded-lg border border-[#DDE2DF] bg-white px-4 text-xs font-medium text-[#293C32] no-underline hover:bg-[#F0F5F0]">Preview
            public profile ↗</a>
    </section>

    <form method="POST" action="<?php echo e(route('admin.profile.update')); ?>" class="space-y-5" id="profile-form">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_330px]">
            <div class="space-y-5">
                <section class="rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm sm:p-6">
                    <div class="mb-5 border-b border-[#EEF1ED] pb-4">
                        <h2 class="text-sm font-semibold text-[#293C32]">Identity & positioning</h2>
                        <p class="mt-1 text-xs text-[#70766F]">Keep the headline concise and understandable for both
                            veterinary professionals and general readers.</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="<?php echo e($label); ?>">Full Name<input class="<?php echo e($input); ?>" name="full_name"
                                value="<?php echo e(old('full_name', $profile->full_name)); ?>" required></label>
                        <label class="<?php echo e($label); ?>">Professional Title<input class="<?php echo e($input); ?>"
                                name="professional_title"
                                value="<?php echo e(old('professional_title', $profile->professional_title)); ?>"
                                placeholder="Veterinarian, DVM"></label>
                        <label class="<?php echo e($label); ?> md:col-span-2">Headline<input class="<?php echo e($input); ?>"
                                name="headline" value="<?php echo e(old('headline', $profile->headline)); ?>"
                                placeholder="Veterinarian, writer & lifelong learner."></label>
                        <label class="<?php echo e($label); ?>">Email<input class="<?php echo e($input); ?>" type="email"
                                name="email" value="<?php echo e(old('email', $profile->email)); ?>"></label>
                        <label class="<?php echo e($label); ?>">Phone<input class="<?php echo e($input); ?>" name="phone"
                                value="<?php echo e(old('phone', $profile->phone)); ?>"></label>
                        <label class="<?php echo e($label); ?> md:col-span-2">Location<input class="<?php echo e($input); ?>"
                                name="location" value="<?php echo e(old('location', $profile->location)); ?>"></label>
                        <label class="<?php echo e($label); ?> md:col-span-2">Short Bio
                            <textarea class="<?php echo e($input); ?> min-h-24 resize-y" name="short_bio" maxlength="1000"><?php echo e(old('short_bio', $profile->short_bio)); ?></textarea><span class="mt-1 block text-[10px] text-[#8A908A]">Used in compact
                                author cards and homepage sections.</span>
                        </label>
                        <label class="<?php echo e($label); ?> md:col-span-2">Full Biography
                            <textarea class="<?php echo e($input); ?> min-h-56 resize-y font-['Newsreader'] text-base leading-7" name="biography"><?php echo e(old('biography', $profile->biography)); ?></textarea>
                        </label>
                    </div>
                </section>

                <section class="rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm sm:p-6">
                    <div class="mb-4">
                        <h2 class="text-sm font-semibold text-[#293C32]">Clinical interests</h2>
                        <p class="mt-1 text-xs text-[#70766F]">One topic per line, for example: Cytology, Oncology, Internal
                            Medicine.</p>
                    </div>
                    <textarea id="interest-lines" class="<?php echo e($input); ?> min-h-32 resize-y"><?php echo e(implode("\n", old('clinical_interests', $profile->clinical_interests ?? []))); ?></textarea>
                    <div id="interest-hidden"></div>
                </section>

                <section class="rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm sm:p-6">
                    <div class="mb-4">
                        <h2 class="text-sm font-semibold text-[#293C32]">Social & external links</h2>
                        <p class="mt-1 text-xs text-[#70766F]">Only fill channels you actively want visitors to see.</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <?php $__currentLoopData = ['linkedin', 'instagram', 'youtube', 'x', 'website']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $network): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="<?php echo e($label); ?>"><?php echo e(ucfirst($network)); ?><input class="<?php echo e($input); ?>"
                                    type="url" name="social_links[<?php echo e($network); ?>]"
                                    value="<?php echo e(old('social_links.' . $network, data_get($profile->social_links, $network))); ?>"
                                    placeholder="https://"></label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>
            </div>

            <aside class="space-y-5">
                <section class="rounded-2xl border border-[#E6EAE4] bg-white p-5 shadow-sm xl:sticky xl:top-24">
                    <h2 class="text-sm font-semibold text-[#293C32]">Profile media</h2>
                    <p class="mt-1 text-xs leading-5 text-[#70766F]">Choose existing images from Media Library. Upload new
                        images there first.</p>
                    <?php if($profile->profilePhoto): ?>
                        <img src="<?php echo e($profile->profilePhoto->url); ?>"
                            class="mt-4 aspect-square w-28 rounded-2xl object-cover" alt="Current profile photo">
                    <?php endif; ?>
                    <label class="<?php echo e($label); ?> mt-4 block">Profile photo<select class="<?php echo e($input); ?>"
                            name="profile_photo_id">
                            <option value="">None</option>
                            <?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($asset->id); ?>" <?php if((string) old('profile_photo_id', $profile->profile_photo_id) === (string) $asset->id): echo 'selected'; endif; ?>>
                                    <?php echo e($asset->original_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </label>
                    <label class="<?php echo e($label); ?> mt-4 block">Hero image<select class="<?php echo e($input); ?>"
                            name="hero_photo_id">
                            <option value="">None</option>
                            <?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($asset->id); ?>" <?php if((string) old('hero_photo_id', $profile->hero_photo_id) === (string) $asset->id): echo 'selected'; endif; ?>>
                                    <?php echo e($asset->original_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select></label>
                    <a href="<?php echo e(route('admin.media.index')); ?>"
                        class="mt-4 inline-flex text-xs font-medium text-[#526A5A] no-underline hover:underline">Open Media
                        Library →</a>
                </section>
            </aside>
        </div>
        <div class="sticky bottom-4 z-20 flex justify-end"><button
                class="inline-flex h-11 items-center rounded-xl bg-[#526A5A] px-5 text-sm font-medium text-white shadow-lg shadow-[#526A5A]/15 transition hover:bg-[#293C32]">Save
                Professional Profile</button></div>
    </form>

    <section class="mt-10">
        <div class="mb-4"><span class="text-[10px] font-semibold tracking-[.1em] text-[#526A5A]">CREDENTIALS &
                CAREER</span>
            <h2 class="mt-1 font-['Newsreader'] text-2xl font-medium text-[#293C32]">Professional timeline</h2>
            <p class="mt-1 text-sm text-[#70766F]">Add credentials here instead of editing code. Existing items can be
                removed and replaced when needed.</p>
        </div>
        <div class="grid gap-4 lg:grid-cols-2">
            <?php echo $__env->make('admin.profile._credential-card', [
                'title' => 'Education',
                'items' => $profile->educations,
                'route' => 'educations',
                'primary' => 'degree',
                'secondary' => 'institution',
                'fields' => [
                    ['degree', 'Degree', 'text'],
                    ['institution', 'Institution', 'text'],
                    ['field_of_study', 'Field of study', 'text'],
                    ['start_year', 'Start year', 'number'],
                    ['end_year', 'End year', 'number'],
                    ['description', 'Description', 'textarea'],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.profile._credential-card', [
                'title' => 'Experience',
                'items' => $profile->experiences,
                'route' => 'experiences',
                'primary' => 'position',
                'secondary' => 'organization',
                'fields' => [
                    ['position', 'Position', 'text'],
                    ['organization', 'Organization', 'text'],
                    ['location', 'Location', 'text'],
                    ['start_date', 'Start date', 'date'],
                    ['end_date', 'End date', 'date'],
                    ['description', 'Description', 'textarea'],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.profile._credential-card', [
                'title' => 'Certifications',
                'items' => $profile->certifications,
                'route' => 'certifications',
                'primary' => 'name',
                'secondary' => 'issuer',
                'fields' => [
                    ['name', 'Certification', 'text'],
                    ['issuer', 'Issuer', 'text'],
                    ['year', 'Year', 'number'],
                    ['credential_id', 'Credential ID', 'text'],
                    ['credential_url', 'Credential URL', 'url'],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.profile._credential-card', [
                'title' => 'Publications',
                'items' => $profile->publications,
                'route' => 'publications',
                'primary' => 'title',
                'secondary' => 'publisher',
                'fields' => [
                    ['title', 'Title', 'text'],
                    ['publisher', 'Publisher', 'text'],
                    ['year', 'Year', 'number'],
                    ['url', 'URL', 'url'],
                    ['description', 'Description', 'textarea'],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.profile._credential-card', [
                'title' => 'Speaking Events',
                'items' => $profile->speakingEvents,
                'route' => 'speaking-events',
                'primary' => 'event_name',
                'secondary' => 'topic',
                'fields' => [
                    ['event_name', 'Event name', 'text'],
                    ['topic', 'Topic', 'text'],
                    ['location', 'Location', 'text'],
                    ['event_date', 'Event date', 'date'],
                    ['url', 'URL', 'url'],
                    ['description', 'Description', 'textarea'],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.profile._credential-card', [
                'title' => 'Memberships',
                'items' => $profile->memberships,
                'route' => 'memberships',
                'primary' => 'organization',
                'secondary' => 'role',
                'fields' => [
                    ['organization', 'Organization', 'text'],
                    ['role', 'Role', 'text'],
                    ['url', 'URL', 'url'],
                    ['description', 'Description', 'textarea'],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </section>

    <?php $__env->startPush('scripts'); ?>
        <script>
            document.getElementById('profile-form')?.addEventListener('submit', () => {
                const box = document.getElementById('interest-hidden');
                box.innerHTML = '';
                document.getElementById('interest-lines').value.split('\n').map(v => v.trim()).filter(Boolean).forEach(
                    v => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'clinical_interests[]';
                        input.value = v;
                        box.appendChild(input);
                    });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ferdy/project-fl/vet-cms/backend/resources/views/admin/profile/edit.blade.php ENDPATH**/ ?>