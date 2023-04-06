<div>
    <div class="flex flex-row">
        <div class="w-90 dark:bg-gray-800 bg-white shadow-md h-screen">
            <button class="dark:text-gray-200 text-gray-800"
                    onclick="toggleFileExplorer()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <ul class="list-none pl-4 hidden md:block file-explorer" id="file-explorer">
                <form wire:submit.prevent="createTag" method="POST" class="py-2 border-b border-gray-200">
                    @csrf
                    @method('POST')
                    <div class="flex flex-row items-center">
                        <input type="text"
                               class="dark:bg-gray-800 dark:text-gray-200 bg-gray-100 text-gray-800 rounded-md w-80"
                               placeholder="Create tag" wire:model.defer="tagName" name="tagName" required>
                        <button type="submit" class="dark:text-gray-200 text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </button>
                    </div>
                </form>

                @foreach($tags as $tag)
                    <li class="py-2 border-b border-gray-200">
                        <div class="flex cursor-pointer flex-row"
                             wire:click="toggleFetchSnippetByTag({{ $tag->id }})">
                            <span class="dark:text-gray-200 text-gray-800 flex flex-row items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-6 w-6 file-explorer__tag-icon-svg-id-{{ $tag->id }}"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5l7 7-7 7"/>
                                    </svg>
                                {{ $tag->name }}
                            </span>
                            <form wire:submit.prevent="deleteTag({{ $tag->id }})" method="POST"
                                  class="ml-auto text-red-500">
                                @csrf
                                <button type="submit" class="dark:text-gray-200 text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                         viewBox="0 0 24 24" stroke="red">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <ul class="pl-4 pt-2">
                            @if ($selectedTagId === $tag->id && !is_null($snippets))
                                @if ($snippets->count() === 0)
                                    <li class="dark:text-gray-200 text-gray-800 cursor-pointer hover:text-blue-500">
                                        No snippets found
                                    </li>
                                @endif
                                <form wire:submit.prevent="createSnippet" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="flex flex-row items-center">
                                        <input type="text"
                                               class="dark:bg-gray-800 dark:text-gray-200 bg-gray-100 text-gray-800 rounded-md"
                                               placeholder="Create snippet" wire:model.defer="newSnippetName"
                                               name="newSnippetName" required>
                                        <input type="hidden" name="snippetTagId"
                                               value="{{ $selectedTagId }}">
                                        <button type="submit" class="dark:text-gray-200 text-gray-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                                @foreach ($snippets as $snippet)
                                    <li class="dark:text-gray-200 text-gray-800 cursor-pointer hover:text-blue-500 flex flex-row"
                                        wire:click="selectSnippet({{ $snippet->id }})"
                                        onclick="replaceEditorContents(`{{ $snippet->content }}`, `{{ $snippet->language }}`)">
                                        {{ $snippet->title }}.{{ $snippet->language }}

                                        <form wire:submit.prevent="deleteSnippet({{ $snippet->id }})"
                                              method="POST"
                                              class="ml-auto text-red-500">
                                            @csrf
                                            <button type="submit" class="dark:text-gray-200 text-gray-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="red">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="w-full bg-white dark:bg-gray-800 shadow-md hidden md:block">
            @if ($selectedSnippet)
                <div class="flex flex-row">
                    <form wire:submit.prevent="updateSnippet" method="POST"
                          class="border-b border-gray-200">
                        @csrf
                        @method('PUT')
                        <input type="text"
                               class="dark:text-gray-200 text-gray-800 bg-transparent border-none"
                               placeholder="{{  $selectedSnippet->title }}" wire:model.defer="snippetName"
                               name="snippetName"
                               value="{{ $selectedSnippet->title }}"
                               required>
                        <span class="dark:text-gray-200 text-gray-800">.{{ $selectedSnippet->language }}</span>

                        <input type="hidden" name="snippetContent" id="snippetContent"
                               wire:model.defer="snippetContent">

                        <button type="submit" class="dark:text-gray-200 text-gray-800 ml-96"
                                wire:click="updateSnippet({{ $selectedSnippet->id }})">
                            <input type="hidden" name="snippetId" value="{{ $selectedSnippet->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 checkmark" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                    </form>
                </div>

            @endif
            <!-- monaco editor -->
            <div id="container" class="editor w-full h-screen"
                 wire:ignore></div>

            <script src=" https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.21.2/min/vs/loader.js"></script>
            <script>
                function toggleFileExplorer() {
                    const fileExplorer = document.getElementById("file-explorer");
                    if (fileExplorer.style.display === "none") {
                        fileExplorer.style.display = "block";
                    } else {
                        fileExplorer.style.display = "none";
                    }
                }

                require.config({paths: {'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.21.2/min/vs'}});

                function replaceEditorContents(text, language) {
                    text = decodeURIComponent(text);
                    window.editor.executeEdits("", [
                        {
                            range: editor.getModel().getFullModelRange(),
                            text: text,
                        }
                    ]);
                    window.editor.setSelection(new monaco.Selection(0, 0, 0, 0));
                    window.editor.focus();
                    if (language === "") {
                        language = "plaintext";
                    }
                    const languageMap = {
                        js: 'javascript',
                        py: 'python',
                        sh: 'shell',
                    }

                    if (languageMap[language]) {
                        language = languageMap[language];
                    }

                    monaco.editor.setModelLanguage(window.editor.getModel(), language);
                }

                require(['vs/editor/editor.main'], function () {
                    if (window.editor) return

                    window.editor = monaco.editor.create(document.getElementById('container'), {
                        value: "",
                        language: "",
                        theme: 'vs-dark',
                        automaticLayout: true,
                        minimap: {
                            enabled: true,
                        },
                        scrollBeyondLastLine: false,
                        wordWrap: 'on',
                        wordWrapColumn: 80,
                        wrappingIndent: 'indent',
                        lineNumbers: 'on',
                    });
                });

                window.editor.onDidChangeModelContent(function (e) {
                    var content = window.editor.getValue();
                    var encodedContent = encodeURIComponent(content);
                    document.getElementById('snippetContent').value = encodedContent;
                    var input = document.getElementById('snippetContent');
                    var event = new Event('input', {bubbles: true});
                    input.dispatchEvent(event);

                    var checkmark = document.getElementsByClassName('checkmark')[0];
                    checkmark.style.color = 'red';
                });


            </script>
        </div>
    </div>
    <script>

    </script>
</div>
