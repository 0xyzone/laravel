<x-layout :titlename=$titlename>

    {{-- Content --}}
    <div class="flex w-full h-full justify-center gap-4">
        <x-clipboard clipTag="BMI Calculator">
            {{-- Form --}}
            <form action="/calculate" method="post" class="w-full px-5 pt-10 lg:px-20 flex flex-col gap-5">
                @csrf
                {{-- Gender Start --}}
                <div class="flex flex-col gap-2">
                    <label for="gender" class="text-white text-2xl">Gender</label>
                    <div class="flex gap-4">
                        {{-- Male --}}
                        <div class="flex items-center hover:cursor-pointer">
                            <input type="radio" name="gender" id="male" value="male"
                                @if (old('gender') == 'male') checked @endif>
                            <label for="male">
                                <img src='https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortCurly&accessoriesType=Blank&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=Heather&eyeType=Happy&eyebrowType=Default&mouthType=Smile&skinColor=Light'
                                    class="w-16" />
                            </label>
                        </div>
                        {{-- Female --}}
                        <div class="flex items-center hover:cursor-pointer">
                            <input type="radio" name="gender" id="female" value="female"
                                @if (old('gender') == 'female') checked @endif>
                            <label for="female">
                                <img src='https://avataaars.io/?avatarStyle=Circle&topType=LongHairBob&accessoriesType=Blank&hairColor=Auburn&facialHairType=Blank&clotheType=Hoodie&clotheColor=PastelRed&eyeType=Happy&eyebrowType=Default&mouthType=Smile&skinColor=Pale'
                                    class="w-16" />
                            </label>
                        </div>
                        {{-- others --}}
                        <div class="flex items-center hover:cursor-pointer">
                            <input type="radio" name="gender" id="others" value="others"
                                @if (old('gender') == 'others') checked @endif>
                            <label for="others">
                                <img src='https://avataaars.io/?avatarStyle=Circle&topType=LongHairStraight&accessoriesType=Blank&hairColor=BrownDark&facialHairType=MoustacheMagnum&facialHairColor=BrownDark&clotheType=CollarSweater&clotheColor=Red&eyeType=Happy&eyebrowType=Default&mouthType=Default&skinColor=Pale'
                                    class="w-16" />
                            </label>
                        </div>
                    </div>
                    @error('gender')
                        <div>
                            <p class="text-sm text-red-100">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- Gender end --}}

                {{-- Age Start --}}
                <div class="flex flex-col gap-2">
                    <label for="age" class="text-white text-2xl">Age</label>
                    <input type="number" name="age" id="age" class="rounded-lg" value="{{ old('age') }}">
                    @error('age')
                        <div>
                            <p class="text-sm text-red-100">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- Age End --}}

                {{-- Height Start --}}
                <div class="flex flex-col gap-2">
                    <label for="height" class="text-white text-2xl">Height</label>
                    <input type="number" name="height" id="height" class="rounded-lg"
                        placeholder="5.2= 5 feet 2 inches" value="{{ old('height') }}" step="0.01">
                    @error('height')
                        <div>
                            <p class="text-sm text-red-100">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- Height End --}}

                {{-- Weight Start --}}
                <div class="flex flex-col gap-2">
                    <label for="weight" class="text-white text-2xl">Weight in kg</label>
                    <input type="number" name="weight" id="weight" class="rounded-lg" value="{{ old('weight') }}"
                        placeholder="Weight in kg" step="0.01">
                    @error('weight')
                        <div>
                            <p class="text-sm text-red-100">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- Weight End --}}

                <button type="submit"
                    class="px-4 py-2 rounded-lg text-white bg-sky-600 w-max text-xl hover:bg-sky-800">Calculate</button>
            </form>
        </x-clipboard>
    </div>

</x-layout>
