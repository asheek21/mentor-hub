 <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
     <h2 class="text-2xl font-semibold text-gray-900 mb-6">Experience</h2>
     <div class="space-y-6">
        @foreach ($experiences as $experience)
            <div class="flex space-x-4">
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i class="fas fa-building text-blue-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">{{ $experience['job_title'] }}</h3>
                    <p class="text-gray-600">{{ $experience['company_name'] }}. •
                         {{ \Carbon\Carbon::parse($experience['start_date'])->format('Y') }} - {{ $experience['current_position'] ? 'Present' : \Carbon\Carbon::parse($experience['end_date'])->format('Y') }}
                    </p>
                    <p class="text-sm text-gray-500 mt-1" title="{{ $experience['description'] }}">
                        {{ $experience['limited_description'] }}
                    </p>
                </div>


            </div>
        @endforeach
     </div>
 </div>
