<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot> -->

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-6 space-y-20">

            @php
            $user = $user ?? auth()->user();
            @endphp

            {{-- Greeting & Slideshow Section --}}
            <section class="space-y-6">
                {{-- Greeting Area --}}
                <p class="text-gray-700">
                    Welcome back <span class="font-bold text-amber-600">{{ $user->name }}</span> - ready for another great day? Book a daycare slot for your pet in just a few clicks.
                </p>

                {{-- Slideshow + Text Section (Responsive 2-Column Side-by-Side Layout) --}}
                {{-- Slideshow + Text Section (Responsive 2-Column Side-by-Side Layout) --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

                    <div id="slideshow" class="relative rounded-xl overflow-hidden shadow-md h-80 sm:h-96 bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1530281700549-e82e7bf110d6?q=80&w=388&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="slide absolute inset-0 w-full h-full object-contain opacity-100 transition-opacity duration-700">
                        <img src="https://plus.unsplash.com/premium_photo-1673967831980-1d377baaded2?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="slide absolute inset-0 w-full h-full object-contain opacity-0 transition-opacity duration-700">
                        <img src="https://images.unsplash.com/photo-1601979031925-424e53b6caaa?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="slide absolute inset-0 w-full h-full object-contain opacity-0 transition-opacity duration-700">
                        <img src="https://images.unsplash.com/flagged/photo-1557427161-4701a0fa2f42?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="slide absolute inset-0 w-full h-full object-contain opacity-0 transition-opacity duration-700">
                        <img src="https://plus.unsplash.com/premium_photo-1661892088256-0a17130b3d0d?q=80&w=580&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="slide absolute inset-0 w-full h-full object-contain opacity-0 transition-opacity duration-700">
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold tracking-wider text-amber-600 uppercase">
                            Happy Pets, Happy Hearts
                        </h3>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight">
                            Loving Pet Care Partners
                        </h2>
                        <p class="text-gray-600 text-base sm:text-lg leading-relaxed">
                            At Pawtopia Pet Care Center, we understand the joy your pet brings to your life. Our mission is to ensure your furry family members receive the best care possible - from cozy accommodation to playful activities.
                        </p>
                        <a href="{{ route('bookings.index') }}"
                            class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg shadow transition-colors">
                            Book Now
                        </a>
                    </div>

                </div>
            </section>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const slides = document.querySelectorAll('#slideshow .slide');
                    let current = 0;
                    setInterval(() => {
                        slides[current].classList.remove('opacity-100');
                        slides[current].classList.add('opacity-0');
                        current = (current + 1) % slides.length;
                        slides[current].classList.add('opacity-100');
                        slides[current].classList.remove('opacity-0');
                    }, 3500);
                });
            </script>

            {{-- Our Services --}}
            <section>
                <h2 class="text-2xl font-bold text-center mb-10">Our Services</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div class="relative overflow-hidden rounded-2xl p-6 h-48 flex items-center bg-gradient-to-br from-amber-500 to-orange-500 shadow">
                        <h3 class="text-white font-bold text-xl leading-snug relative z-10 max-w-[55%]">
                            Fun &amp; Engaging Activities
                        </h3>
                        <img src="https://images.unsplash.com/photo-1787152467585-3b6a11777ebd?q=80&w=774&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="absolute right-0 bottom-0 w-32 h-32 object-cover rounded-tl-2xl">
                    </div>

                    <div class="rounded-2xl p-6 h-48 flex items-center justify-center text-center bg-gray-100 shadow-sm">
                        <h3 class="text-gray-800 font-bold text-xl leading-snug">
                            Spacious &amp; Cozy Boarding
                        </h3>
                    </div>

                    <div class="relative overflow-hidden rounded-2xl p-6 h-48 flex items-center bg-gradient-to-br from-amber-500 to-orange-500 shadow">
                        <h3 class="text-white font-bold text-xl leading-snug relative z-10 max-w-[55%]">
                            Nutritious Meals
                        </h3>
                        <img src="https://images.unsplash.com/photo-1745252752503-2c5eb22167b6?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="absolute right-0 bottom-0 w-32 h-32 object-cover rounded-tl-2xl">
                    </div>

                    <div class="rounded-2xl p-6 h-48 flex items-center justify-center text-center bg-gray-100 shadow-sm">
                        <h3 class="text-gray-800 font-bold text-xl leading-snug">
                            24 × 7 Supervision
                        </h3>
                    </div>

                    <div class="relative overflow-hidden rounded-2xl p-6 h-48 flex items-center bg-gradient-to-br from-amber-500 to-orange-500 shadow sm:col-span-2 lg:col-span-1">
                        <h3 class="text-white font-bold text-xl leading-snug relative z-10 max-w-[55%]">
                            Pet Grooming
                        </h3>
                        <img src="https://images.unsplash.com/photo-1581888475780-27b6b0bc3690?q=80&w=435&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="absolute right-0 bottom-0 w-32 h-32 object-cover rounded-tl-2xl">
                    </div>

                </div>
            </section>

            {{-- Why Choose Us --}}
            <section class="bg-white rounded-xl shadow p-8 sm:p-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <img src="https://images.unsplash.com/photo-1781894056299-b6eae2f31dd2?q=80&w=376&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="rounded-xl object-cover w-full h-81">

                    <div>
                        <h2 class="text-2xl font-bold mb-4">Why Choose Us</h2>
                        <ul class="space-y-3 text-gray-700">
                            <ul class="space-y-3 text-gray-700">

                                <li class="flex items-start gap-2">
                                    <span class="text-amber-500">✔</span>
                                    <div>
                                        <span class="font-medium">Certified Professional Caregivers</span>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Our trained caregivers ensure the best care for your pets
                                        </p>
                                    </div>
                                </li>

                                <li class="flex items-start gap-2">
                                    <span class="text-amber-500">✔</span>
                                    <div>
                                        <span class="font-medium">Customized Care</span>
                                        <p class="text-sm text-gray-500 mt-1">
                                            We provide personalized care plans for each pet's unique needs
                                        </p>
                                    </div>
                                </li>

                                <li class="flex items-start gap-2">
                                    <span class="text-amber-500">✔</span>
                                    <div>
                                        <span class="font-medium">Safe & Loving Environment</span>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Your pets will feel at ease in our secure and friendly space
                                        </p>
                                    </div>
                                </li>

                                <li class="flex items-start gap-2">
                                    <span class="text-amber-500">✔</span>
                                    <div>
                                        <span class="font-medium">Flexible daycare and boarding options</span>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Choose flexible care options that fit your schedule and your pet's needs
                                        </p>
                                    </div>
                                </li>

                            </ul>
                        </ul>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>