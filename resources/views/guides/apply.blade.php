<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Guide Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800">
    <div class="max-w-3xl mx-auto p-4">
        <div class="mb-8">
            <h1 class="text-4xl font-bold">Guide Registration</h1>
            <p class="mt-2 text-slate-600">Apply to become a local tour guide on the platform.</p>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-3xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-4 rounded-3xl bg-red-50 border border-red-200 p-4 text-red-800">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
            <form action="{{ route('guides.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700">Full name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" required>
                </div>
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Experience (years)</label>
                        <input type="number" name="experience_years" value="{{ old('experience_years') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" min="0" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Price per day</label>
                        <input type="number" step="0.01" name="price_per_day" value="{{ old('price_per_day') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" required>
                    </div>
                </div>
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Languages</label>
                        <input type="text" name="languages" value="{{ old('languages') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Specialization</label>
                        <input type="text" name="specialization" value="{{ old('specialization') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Destination</label>
                    <select name="destination_id" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                        <option value="">Select a destination</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ old('destination_id') == $destination->id ? 'selected' : '' }}>{{ $destination->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Profile photo</label>
                    <input type="file" name="photo" class="mt-2 w-full text-slate-700">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Bio</label>
                    <textarea name="bio" rows="5" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('bio') }}</textarea>
                </div>
                <button type="submit" class="inline-flex w-full justify-center rounded-full bg-blue-600 px-6 py-3 text-white font-semibold hover:bg-blue-700 transition">Submit Application</button>
            </form>
        </div>
    </div>
</body>
</html>
