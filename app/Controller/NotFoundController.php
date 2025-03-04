<?php

    class NotFoundController
    {
        public function Index()
        {
            echo '
            
            <html lang="PT-br">

            <head>
                <meta charset="utf-8" />
                <title> 404 </title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta content="Techzaa" name="author" />
                <link rel="shortcut icon" href="assets/images/favicon.ico">
                <link href="style.min.css" rel="stylesheet" type="text/css">
            </head>
            <style>
            @import url(https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap);

                *,
                ::after,
                ::before {
                    box-sizing: border-box;
                    border: 0 solid #ffffff;
                    --tw-border-spacing-x: 0;
                    --tw-border-spacing-y: 0;
                    --tw-translate-x: 0;
                    --tw-translate-y: 0;
                    --tw-rotate: 0;
                    --tw-skew-x: 0;
                    --tw-skew-y: 0;
                    --tw-scale-x: 1;
                    --tw-scale-y: 1;
                    --tw-pan-x: ;
                    --tw-pan-y: ;
                    --tw-pinch-zoom: ;
                    --tw-scroll-snap-strictness: proximity;
                    --tw-gradient-from-position: ;
                    --tw-gradient-via-position: ;
                    --tw-gradient-to-position: ;
                    --tw-ordinal: ;
                    --tw-slashed-zero: ;
                    --tw-numeric-figure: ;
                    --tw-numeric-spacing: ;
                    --tw-numeric-fraction: ;
                    --tw-ring-inset: ;
                    --tw-ring-offset-width: 0px;
                    --tw-ring-offset-color: #ffffff;
                    --tw-ring-color: rgb(59 130 246 / 0.5);
                    --tw-ring-offset-shadow: 0 0 #0000;
                    --tw-ring-shadow: 0 0 #0000;
                    --tw-shadow: 0 0 #0000;
                    --tw-shadow-colored: 0 0 #00000000;
                    --tw-blur: ;
                    --tw-brightness: ;
                    --tw-contrast: ;
                    --tw-grayscale: ;
                    --tw-hue-rotate: ;
                    --tw-invert: ;
                    --tw-saturate: ;
                    --tw-sepia: ;
                    --tw-drop-shadow: ;
                    --tw-backdrop-blur: ;
                    --tw-backdrop-brightness: ;
                    --tw-backdrop-contrast: ;
                    --tw-backdrop-grayscale: ;
                    --tw-backdrop-hue-rotate: ;
                    --tw-backdrop-invert: ;
                    --tw-backdrop-opacity: ;
                    --tw-backdrop-saturate: ;
                    --tw-backdrop-sepia:
                }

                ::after,
                ::before {
                    --tw-content: ""
                }

                html {
                    line-height: 1.5;
                    -webkit-text-size-adjust: 100%;
                    -moz-tab-size: 4;
                    -o-tab-size: 4;
                    tab-size: 4;
                    font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                    font-feature-settings: normal;
                    font-variation-settings: normal;
                    position: relative;
                    scroll-behavior: smooth
                }

                body {
                    margin: 0;
                    line-height: inherit
                }

                hr {
                    height: 0;
                    color: inherit;
                    border-top-width: 1px
                }

                abbr:where([title]) {
                    -webkit-text-decoration: underline dotted;
                    text-decoration: underline dotted
                }

                h1,
                h2,
                h3,
                h4,
                h5,
                h6 {
                    font-size: inherit
                }

                a {
                    color: inherit;
                    text-decoration: inherit
                }

                b,
                strong {
                    font-weight: bolder
                }

                code,
                kbd,
                pre,
                samp {
                    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                    font-size: 1em
                }

                small {
                    font-size: 80%
                }

                sub,
                sup {
                    font-size: 75%;
                    line-height: 0;
                    position: relative;
                    vertical-align: baseline
                }

                sub {
                    bottom: -.25em
                }

                sup {
                    top: -.5em
                }

                table {
                    text-indent: 0;
                    border-color: inherit;
                    border-collapse: collapse
                }

                button,
                input,
                optgroup,
                select,
                textarea {
                    font-family: inherit;
                    font-size: 100%;
                    font-weight: inherit;
                    line-height: inherit;
                    color: inherit;
                    margin: 0;
                    padding: 0
                }

                button,
                select {
                    text-transform: none
                }

                [type=button],
                [type=reset],
                [type=submit],

                :-moz-focusring {
                    outline: auto
                }

                :-moz-ui-invalid {
                    box-shadow: none
                }

                progress {
                    vertical-align: baseline
                }

                ::-webkit-inner-spin-button,
                ::-webkit-outer-spin-button {
                    height: auto
                }

                ::-webkit-search-decoration {
                    -webkit-appearance: none
                }

                ::-webkit-file-upload-button {
                    -webkit-appearance: button;
                    font: inherit
                }

                summary {
                    display: list-item
                }

                blockquote,
                dd,
                dl,
                figure,
                h1,
                h2,
                h3,
                h4,
                h5,
                h6,
                hr,
                p,
                pre {
                    margin: 0
                }

                fieldset {
                    margin: 0;
                    padding: 0
                }

                legend {
                    padding: 0
                }

                menu,
                ol,
                ul {
                    list-style: none;
                    margin: 0;
                    padding: 0
                }

                textarea {
                    resize: vertical
                }

                input::-moz-placeholder,
                textarea::-moz-placeholder {
                    opacity: 1;
                    color: #ffffff
                }

                input::placeholder,
                textarea::placeholder {
                    opacity: 1;
                    color: #6f7277
                }

                [role=button],
                button {
                    cursor: pointer
                }

                :disabled {
                    cursor: default
                }

                [hidden] {
                    display: none
                }

                ::backdrop {
                    --tw-border-spacing-x: 0;
                    --tw-border-spacing-y: 0;
                    --tw-translate-x: 0;
                    --tw-translate-y: 0;
                    --tw-rotate: 0;
                    --tw-skew-x: 0;
                    --tw-skew-y: 0;
                    --tw-scale-x: 1;
                    --tw-scale-y: 1;
                    --tw-pan-x: ;
                    --tw-pan-y: ;
                    --tw-pinch-zoom: ;
                    --tw-scroll-snap-strictness: proximity;
                    --tw-gradient-from-position: ;
                    --tw-gradient-via-position: ;
                    --tw-gradient-to-position: ;
                    --tw-ordinal: ;
                    --tw-slashed-zero: ;
                    --tw-numeric-figure: ;
                    --tw-numeric-spacing: ;
                    --tw-numeric-fraction: ;
                    --tw-ring-inset: ;
                    --tw-ring-offset-width: 0px;
                    --tw-ring-offset-color: #fff;
                    --tw-ring-color: rgb(59 130 246 / 0.5);
                    --tw-ring-offset-shadow: 0 0 #0000;
                    --tw-ring-shadow: 0 0 #0000;
                    --tw-shadow: 0 0 #0000;
                    --tw-shadow-colored: 0 0 #0000;
                    --tw-blur: ;
                    --tw-brightness: ;
                    --tw-contrast: ;
                    --tw-grayscale: ;
                    --tw-hue-rotate: ;
                    --tw-invert: ;
                    --tw-saturate: ;
                    --tw-sepia: ;
                    --tw-drop-shadow: ;
                    --tw-backdrop-blur: ;
                    --tw-backdrop-brightness: ;
                    --tw-backdrop-contrast: ;
                    --tw-backdrop-grayscale: ;
                    --tw-backdrop-hue-rotate: ;
                    --tw-backdrop-invert: ;
                    --tw-backdrop-opacity: ;
                    --tw-backdrop-saturate: ;
                    --tw-backdrop-sepia:
                }

                .container {
                    width: 100%;
                    margin-right: auto;
                    margin-left: auto
                }

                @media (min-width:640px) {
                    .container {
                        max-width: 640px
                    }
                }

                @media (min-width:768px) {
                    .container {
                        max-width: 768px
                    }
                }

                @media (min-width:1024px) {
                    .container {
                        max-width: 1024px
                    }
                }

                @media (min-width:1280px) {
                    .container {
                        max-width: 1280px
                    }
                }

                @media (min-width:1536px) {
                    .container {
                        max-width: 1536px
                    }
                }

                .absolute {
                    position: absolute
                }

                .relative {
                    position: relative
                }

                .inset-0 {
                    inset: 0px
                }

                .z-30 {
                    z-index: 30
                }

                .mx-1 {
                    margin-left: .25rem;
                    margin-right: .25rem
                }

                .mx-10 {
                    margin-left: 2.5rem;
                    margin-right: 2.5rem
                }

                .mx-14 {
                    margin-left: 3.5rem;
                    margin-right: 3.5rem
                }

                .mx-auto {
                    margin-left: auto;
                    margin-right: auto
                }

                .my-3 {
                    margin-top: .75rem;
                    margin-bottom: .75rem
                }

                .mb-1 {
                    margin-bottom: .25rem
                }

                .mb-10 {
                    margin-bottom: 2.5rem
                }

                .mb-2 {
                    margin-bottom: .5rem
                }

                .mb-3 {
                    margin-bottom: .75rem
                }

                .mb-4 {
                    margin-bottom: 1rem
                }

                .mb-5 {
                    margin-bottom: 1.25rem
                }

                .mb-7 {
                    margin-bottom: 1.75rem
                }

                .ml-auto {
                    margin-left: auto
                }

                .ms-2 {
                    -webkit-margin-start: 0.5rem;
                    margin-inline-start: .5rem
                }

                .mt-10 {
                    margin-top: 2.5rem
                }

                .mt-5 {
                    margin-top: 1.25rem
                }

                .mt-8 {
                    margin-top: 2rem
                }

                .block {
                    display: block
                }

                .flex {
                    display: flex
                }

                .grid {
                    display: grid
                }

                .h-0 {
                    height: 0
                }

                .h-28 {
                    height: 7rem
                }

                .h-36 {
                    height: 9rem
                }

                .h-44 {
                    height: 11rem
                }

                .h-6 {
                    height: 1.5rem
                }

                .h-72 {
                    height: 18rem
                }

                .h-96 {
                    height: 24rem
                }

                .h-full {
                    height: 100%
                }

                .w-6 {
                    width: 1.5rem
                }

                .w-full {
                    width: 100%
                }

                .max-w-2xl {
                    max-width: 42rem
                }

                .max-w-lg {
                    max-width: 32rem
                }

                .max-w-md {
                    max-width: 28rem
                }

                .max-w-xl {
                    max-width: 36rem
                }

                .resize {
                    resize: both
                }

                .scroll-mt-5 {
                    scroll-margin-top: 1.25rem
                }

                .flex-col {
                    flex-direction: column
                }

                .flex-wrap {
                    flex-wrap: wrap
                }

                .items-center {
                    align-items: center
                }

                .justify-center {
                    justify-content: center
                }

                .gap-4 {
                    gap: 1rem
                }

                .scroll-smooth {
                    scroll-behavior: smooth
                }

                .rounded {
                    border-radius: .25rem
                }

                .rounded-full {
                    border-radius: 9999px
                }

                .rounded-lg {
                    border-radius: .5rem
                }

                .rounded-md {
                    border-radius: .375rem
                }

                .border {
                    border-width: 1px
                }

                .border-2 {
                    border-width: 2px
                }

                .border-b {
                    border-bottom-width: 1px
                }

                .border-black {
                    --tw-border-opacity: 1;
                    border-color: rgb(0 0 0 / var(--tw-border-opacity))
                }

                .border-black\/60 {
                    border-color: rgba(17, 17, 17, 0.6)
                }

                .border-cyan-500 {
                    --tw-border-opacity: 1;
                    border-color: #e3464c
                }

                .border-gray-100 {
                    --tw-border-opacity: 1;
                    border-color: #e3464c
                }

                .border-transparent {
                    border-color: white
                }

                .bg-amber-800\/10 {
                    background-color: rgba(238, 169, 127, 0.1)
                }

                .bg-black\/60 {
                    background-color: rgb(0 0 0 / .6)
                }

                .bg-blue-600 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(37 99 235 / var(--tw-bg-opacity))
                }

                .bg-blue-950 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(23 37 84 / var(--tw-bg-opacity))
                }

                .bg-cyan-500 {
                    --tw-bg-opacity: 1;
                    background-color: #e3464c
                }

                .bg-cyan-600 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(8 145 178 / var(--tw-bg-opacity))
                }

                .bg-fuchsia-50 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(253 244 255 / var(--tw-bg-opacity))
                }

                .bg-gray-100 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(243 244 246 / var(--tw-bg-opacity))
                }

                .bg-orange-100 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(255 237 213 / var(--tw-bg-opacity))
                }

                .bg-sky-600 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(2 132 199 / var(--tw-bg-opacity))
                }

                .bg-white {
                    --tw-bg-opacity: 1;
                    background-color: rgb(255 255 255 / var(--tw-bg-opacity))
                }

                .bg-\[url\(\'\.\.\/images\/error-1\.png\'\)\] {
                    background-image: url("../images/error-1.png")
                }

                .bg-\[url\(\'\.\.\/images\/error-6\.png\'\)\] {
                    background-image: url("../images/error-6.png")
                }

                .bg-\[url\(\'\.\.\/images\/error-7\.png\'\)\] {
                    background-image: url("../images/error-7.png")
                }

                .bg-\[url\(\'\.\.\/images\/error-8\.png\'\)\] {
                    background-image: url("../images/error-8.png")
                }

                .bg-gradient-to-b {
                    background-image: linear-gradient(to bottom, var(--tw-gradient-stops))
                }

                .bg-gradient-to-bl {
                    background-image: linear-gradient(to bottom left, var(--tw-gradient-stops))
                }

                .bg-gradient-to-br {
                    background-image: linear-gradient(to bottom right, var(--tw-gradient-stops))
                }

                .bg-gradient-to-l {
                    background-image: linear-gradient(to left, var(--tw-gradient-stops))
                }

                .from-cyan-50 {
                    --tw-gradient-from: #333232 var(--tw-gradient-from-position);
                    --tw-gradient-to: rgb(236 254 255 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
                }

                .from-pink-100 {
                    --tw-gradient-from: #333232 var(--tw-gradient-from-position);
                    --tw-gradient-to: rgb(252 231 243 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
                }

                .from-pink-400 {
                    --tw-gradient-from: #333232 var(--tw-gradient-from-position);
                    --tw-gradient-to: rgb(244 114 182 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
                }

                .from-purple-300 {
                    --tw-gradient-from: #333232 var(--tw-gradient-from-position);
                    --tw-gradient-to: #333232 var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
                }

                .to-blue-600 {
                    --tw-gradient-to: black var(--tw-gradient-to-position)
                }

                .to-cyan-100 {
                    --tw-gradient-to: black var(--tw-gradient-to-position)
                }

                .to-cyan-500 {
                    --tw-gradient-to: black var(--tw-gradient-to-position)
                }

                .to-lime-100 {
                    --tw-gradient-to: black var(--tw-gradient-to-position)
                }

                .bg-cover {
                    background-size: cover
                }

                .bg-clip-text {
                    -webkit-background-clip: text;
                    background-clip: text
                }

                .bg-bottom {
                    background-position: bottom
                }

                .bg-center {
                    background-position: center
                }

                .bg-no-repeat {
                    background-repeat: no-repeat
                }

                .p-2 {
                    padding: .5rem
                }

                .p-3 {
                    padding: .75rem
                }

                .px-10 {
                    padding-left: 2.5rem;
                    padding-right: 2.5rem
                }

                .px-4 {
                    padding-left: 1rem;
                    padding-right: 1rem
                }

                .px-5 {
                    padding-left: 1.25rem;
                    padding-right: 1.25rem
                }

                .px-7 {
                    padding-left: 1.75rem;
                    padding-right: 1.75rem
                }

                .px-8 {
                    padding-left: 2rem;
                    padding-right: 2rem
                }

                .py-10 {
                    padding-top: 1.5rem;
                    padding-bottom: 2.5rem
                }

                .py-14 {
                    padding-top: 2.5rem;
                    padding-bottom: 3.5rem
                }

                .py-2 {
                    padding-top: .5rem;
                    padding-bottom: .5rem
                }

                .py-2\.5 {
                    padding-top: .625rem;
                    padding-bottom: .625rem
                }

                .py-20 {
                    padding-top: 5rem;
                    padding-bottom: 5rem
                }

                .py-3 {
                    padding-top: .75rem;
                    padding-bottom: .75rem
                }

                .py-8 {
                    padding-top: 2rem;
                    padding-bottom: 2rem
                }

                .pb-16 {
                    padding-bottom: 4rem
                }

                .text-center {
                    text-align: center
                }

                .text-2xl {
                    font-size: 1.5rem;
                    line-height: 2rem
                }

                .text-4xl {
                    font-size: 2.25rem;
                    line-height: 2.5rem
                }

                .text-8xl {
                    font-size: 6rem;
                    line-height: 1
                }

                .text-9xl {
                    font-size: 8rem;
                    line-height: 1
                }

                .text-lg {
                    font-size: 1.125rem;
                    line-height: 1.75rem
                }

                .text-sm {
                    font-size: .875rem;
                    line-height: 1.25rem
                }

                .text-xl {
                    font-size: 1.25rem;
                    line-height: 1.75rem
                }

                .font-bold {
                    font-weight: 700
                }

                .font-medium {
                    font-weight: 500
                }

                .font-normal {
                    font-weight: 400
                }

                .font-semibold {
                    font-weight: 600
                }

                .uppercase {
                    text-transform: uppercase
                }

                .leading-\[50px\] {
                    line-height: 50px
                }

                .leading-relaxed {
                    line-height: 1.625
                }

                .tracking-wide {
                    letter-spacing: .025em
                }

                .text-amber-800 {
                    --tw-text-opacity: 1;
                    color: rgb(146 64 14 / var(--tw-text-opacity))
                }

                .text-black {
                    --tw-text-opacity: 1;
                    color: rgb(0 0 0 / var(--tw-text-opacity))
                }

                .text-black\/70 {
                    color: rgb(0 0 0 / .7)
                }

                .text-blue-500 {
                    --tw-text-opacity: 1;
                    color: #e3464c
                }

                .text-cyan-500 {
                    --tw-text-opacity: 1;
                    color: #e3464c
                }

                .text-cyan-600 {
                    --tw-text-opacity: 1;
                    color: rgb(8 145 178 / var(--tw-text-opacity))
                }

                .text-gray-500 {
                    --tw-text-opacity: 1;
                    color: rgb(107 114 128 / var(--tw-text-opacity))
                }

                .text-gray-600 {
                    --tw-text-opacity: 1;
                    color: black
                }

                .text-gray-700 {
                    --tw-text-opacity: 1;
                    color: rgb(55 65 81 / var(--tw-text-opacity))
                }

                .text-gray-800 {
                    --tw-text-opacity: 1;
                    color: rgb(31 41 55 / var(--tw-text-opacity))
                }

                .text-orange-500 {
                    --tw-text-opacity: 1;
                    color: rgb(249 115 22 / var(--tw-text-opacity))
                }

                .text-transparent {
                    color: #e3464c;
                }

                .text-white {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity))
                }

                .opacity-0 {
                    opacity: 0
                }

                .shadow-lg {
                    --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                    --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
                    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
                }

                .transition-all {
                    transition-property: all;
                    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                    transition-duration: 150ms
                }

                .duration-300 {
                    transition-duration: .3s
                }

                .ease-out {
                    transition-timing-function: cubic-bezier(0, 0, 0.2, 1)
                }

                body {
                    font-size: 18px;
                    overflow-x: hidden;
                    font-family: Montserrat, sans-serif;
                    --tw-text-opacity: 1;
                    color: rgb(17 24 39 / var(--tw-text-opacity))
                }

                h1,
                h2,
                h3,
                h4,
                h5,
                h6 {
                    font-weight: 600
                }

                .hover\:bg-black:hover {
                    --tw-bg-opacity: 1;
                    background-color: rgb(0 0 0 / var(--tw-bg-opacity))
                }

                .hover\:bg-cyan-500:hover {
                    --tw-bg-opacity: 1;
                    background-color: #e3464c
                }

                .hover\:bg-white:hover {
                    --tw-bg-opacity: 1;
                    background-color: rgb(255 255 255 / var(--tw-bg-opacity))
                }

                .hover\:text-black:hover {
                    --tw-text-opacity: 1;
                    color: rgb(0 0 0 / var(--tw-text-opacity))
                }

                .hover\:text-blue-500:hover {
                    --tw-text-opacity: 1;
                    color: rgb(59 130 246 / var(--tw-text-opacity))
                }

                .hover\:text-white:hover {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity))
                }

                @media (min-width:640px) {
                    .sm\:h-36 {
                        height: 9rem
                    }

                    .sm\:h-\[36rem\] {
                        height: 36rem
                    }

                    .sm\:px-20 {
                        padding-left: 5rem;
                        padding-right: 5rem
                    }

                    .sm\:px-24 {
                        padding-left: 6rem;
                        padding-right: 6rem
                    }

                    .sm\:text-2xl {
                        font-size: 1.5rem;
                        line-height: 2rem
                    }

                    .sm\:text-3xl {
                        font-size: 1.875rem;
                        line-height: 2.25rem
                    }

                    .sm\:text-\[150px\] {
                        font-size: 150px
                    }

                    .sm\:text-\[170px\] {
                        font-size: 170px
                    }

                    .sm\:text-\[180px\] {
                        font-size: 180px
                    }

                    .sm\:text-\[200px\] {
                        font-size: 200px
                    }

                    .sm\:transition-none {
                        transition-property: none
                    }
                }

                @media (min-width:768px) {
                    .md\:mt-0 {
                        margin-top: 0
                    }

                    .md\:flex {
                        display: flex
                    }

                    .md\:hidden {
                        display: none
                    }

                    .md\:w-auto {
                        width: auto
                    }

                    .md\:flex-grow {
                        flex-grow: 1
                    }

                    .md\:flex-row {
                        flex-direction: row
                    }

                    .md\:items-center {
                        align-items: center
                    }

                    .md\:border-b-0 {
                        border-bottom-width: 0
                    }

                    .md\:opacity-100 {
                        opacity: 1
                    }

                    .md\:transition-none {
                        transition-property: none
                    }
                }

                @media (min-width:1024px) {
                    .lg\:flex {
                        display: flex
                    }

                    .lg\:grid-cols-3 {
                        grid-template-columns: repeat(3, minmax(0, 1fr))
                    }

                    .lg\:px-6 {
                        padding-left: 1.5rem;
                        padding-right: 1.5rem
                    }
                }

                /*# sourceMappingURL=style.min.css.map */
            </style>
            <body>
                    <div class="container" style="margin-top: 10%">
                        <div class="bg-white rounded-lg shadow-lg text-center max-w-2xl mx-auto py-10 sm:px-20 px-5">

                            <h1 class="sm:text-[170px] text-9xl font-bold text-transparent bg-clip-text bg-gradient-to-bl from-purple-300 to-cyan-500 mb-5">404</h1>
                            <h3 class="text-gray-600 text-xl uppercase font-bold mb-3">ops! Página não encontrada</h3>
                            <p class="font-medium text-gray-500 leading-relaxed">Desculpe, a página que você procura não foi encontrada. Volte para a segurança clicando no botão da página inicial.</p>
                        </div>
                    </div>

            </body>

            </html>
            
            ';
        }
    }