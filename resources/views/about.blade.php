<div
    class=" mx-auto sm:px-6 lg:px-8 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden pt-4 pb-4 pl-4 pr-4">
    <div class="flex flex-col justify-center">
        <h1 class="text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4">
            About Me
        </h1>
        <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">

            Hello, my name is Justin Jongstra and I am a 21 year old student. I have a passion for learning, mountain
            biking, drawing, playing games, and coding. I love to study and challenge myself in new and exciting ways,
            and I
            am always looking for ways to expand my knowledge and grow as a person. In my free time, I enjoy hitting the
            trails on my mountain bike and exploring new places, as well as playing video games and coding projects. I
            am a
            creative individual who is constantly seeking new opportunities to express my ideas and bring them to life.

            I am mostly interested in PHP (especially the laravel framework currently), C++ and JavaScript, but I'm
            always
            open to learning new languages and frameworks. I am currently studying at RijnIJssel in Arnhem, the
            Netherlands,
            where I am studying for an MBO 4 diploma in Software Development.
        </h3>
    </div>
    <livewire:about-carousel/>
<<<<<<< HEAD
=======

    <div class="flex flex-col justify-center">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
            My Skills
        </h1>
        @php
            $skills = ['PHP','C#','C++','Python','Laravel','Tailwind','SCSS',];
            $personalSkills = ['Teamwork','Problem Solving','Creativity',];
        @endphp

        <div class="flex flex-wrap p-2">
            @foreach ($skills as $skill)
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold bg-purple-100 text-purple-800 cursor-default dark:bg-purple-800 dark:text-purple-100 mr-2 p-2 text-center justify-center rounded-md mb-2">
            {{ $skill }}
        </span>
            @endforeach
        </div>
        <div class="flex flex-wrap p-2">
            @foreach ($personalSkills as $skill)
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold bg-pink-100 text-pink-800 cursor-default dark:bg-pink-800 dark:text-pink-100 mr-2 p-2 text-center justify-center rounded-md mb-2">
            {{ $skill }}
        </span>
            @endforeach
        </div>
    </div>

    <div class="flex flex-col justify-center">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
            My previous studies
        </h1>
        <ul class="list-disc list-inside">
            <li>Vehicle engineering
                <span
                    class="px-2 inline-flex text-sm leading-5 font-semibold bg-blue-400 text-white cursor-default dark:bg-blue-300 dark:text-blue-900 text-center justify-center rounded-md">Kader</span>
                <span
                    class="px-2 inline-flex text-sm leading-5 font-semibold bg-green-400 text-white cursor-default dark:bg-green-300 dark:text-green-900 text-center justify-center rounded-md">Graduated</span>
            </li>
            <li>Mechatronics
                <span
                    class="px-2 inline-flex text-sm leading-5 font-semibold bg-blue-400 text-white cursor-default dark:bg-blue-300 dark:text-blue-900 text-center justify-center rounded-md">MBO 3</span>
                <span
                    class="px-2 inline-flex text-sm leading-5 font-semibold bg-green-400 text-white cursor-default dark:bg-green-300 dark:text-green-900 text-center justify-center rounded-md">Studied for 2 years</span>
            </li>
            <li>IT Systems and Devices All-Around Worker
                <span
                    class="px-2 inline-flex text-sm leading-5 font-semibold bg-blue-400 text-white cursor-default dark:bg-blue-300 dark:text-blue-900 text-center justify-center rounded-md">MBO 3</span>
                <span
                    class="px-2 inline-flex text-sm leading-5 font-semibold bg-green-400 text-white cursor-default dark:bg-green-300 dark:text-green-900 text-center justify-center rounded-md">Graduated</span>
            </li>
            <li>Software development
                <span
                    class="px-2 inline-flex text-sm leading-5 font-semibold bg-blue-400 text-white cursor-default dark:bg-blue-300 dark:text-blue-900 text-center justify-center rounded-md">MBO 4</span>
                <span
                    class="px-2 inline-flex text-sm leading-5 font-semibold bg-yellow-400 text-white cursor-default dark:bg-yellow-300 dark:text-yellow-900 text-center justify-center rounded-md">Still Studying</span>
            </li>
        </ul>

    </div>
>>>>>>> development
</div>
