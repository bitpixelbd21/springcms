@extends('river::admin.install.layout')

@section('content')
    <div class="container container-tight py-4" style="max-width: 30rem;">
        
        <div class="card card-md">
          <div class="card-body text-center py-4 p-sm-5">
            <svg class="img mb-n2" xmlns="http://www.w3.org/2000/svg" height="200" fill="none" viewBox="0 0 800 600">
              <style>
                :where(.theme-dark, [data-bs-theme="dark"]) .tblr-illustrations-boy-girl-a { fill: black; opacity: 0.07; } :where(.theme-dark, [data-bs-theme="dark"]) .tblr-illustrations-boy-girl-b { fill: #1A2030; } :where(.theme-dark, [data-bs-theme="dark"]) .tblr-illustrations-boy-girl-c { fill: #454C5E; }
                @media (prefers-color-scheme: dark) { .tblr-illustrations-boy-girl-a { fill: black; opacity: 0.07; } .tblr-illustrations-boy-girl-b { fill: #1A2030; } .tblr-illustrations-boy-girl-c { fill: #454C5E; } }
              </style>
              <path d="M658.744 282.266C658.744 325.973 612.535 357.656 592.114 392.937C571.053 429.346 565.991 484.976 529.581 506.037C494.299 526.458 444.065 503.618 400.367 503.618C356.669 503.618 306.435 526.458 271.153 506.037C234.753 484.976 229.681 429.346 208.62 392.937C188.209 357.656 142 325.953 142 282.266C142 238.579 188.209 206.865 208.62 171.584C229.681 135.185 234.753 79.5143 271.153 58.4839C306.435 38.0736 356.669 60.9031 400.367 60.9031C444.065 60.9031 494.299 38.0736 529.581 58.4839C565.991 79.5448 571.053 135.185 592.114 171.584C612.535 206.865 658.744 238.568 658.744 282.266Z" fill="#F7F8FC" class="tblr-illustrations-boy-girl-a"></path>
              <path d="M397.248 550C534.459 550 645.689 545.836 645.689 540.7C645.689 535.564 534.459 531.401 397.248 531.401C260.038 531.401 148.808 535.564 148.808 540.7C148.808 545.836 260.038 550 397.248 550Z" fill="#A6A9B3" class="tblr-illustrations-boy-girl-b"></path>
              <path d="M479.179 238.829C475.497 244.691 456.146 274.402 421.211 280.161C408.559 282.198 395.593 280.84 383.637 276.225C376.963 273.704 370.647 270.322 364.85 266.164L373.304 245.592C374.244 246.41 375.7 247.659 377.607 249.049C384.182 253.84 395.868 260.321 407.863 256.273C414.608 254.009 419.323 249.697 428.36 240.849C436.25 233.084 443.39 224.592 449.683 215.486C455.319 205.153 466.977 202.626 474.943 209.512C482.598 215.974 484.609 229.097 479.179 238.829Z" fill="#FFCB9D" style="fill: #FFCB9D; fill: var(--tblr-illustrations-skin, #FFCB9D);"></path>
              <path d="M383.666 276.159C376.992 273.638 370.676 270.256 364.879 266.098L373.333 245.526C374.272 246.344 375.728 247.593 377.635 248.983C377.119 253.445 376.818 260.697 379.035 266.568C380.328 269.88 381.876 273.087 383.666 276.159Z" fill="black" opacity="0.15"></path>
              <path d="M324.054 160.289C332.183 175.733 345.737 187.624 362.107 193.674L307.502 198.718C313.026 185.906 318.543 173.096 324.054 160.289Z" fill="#232B41" class="tblr-illustrations-boy-girl-c"></path>
              <path d="M302.083 425.902L299.434 457.398L295.601 503.211H291.872L282.206 455.679L278.073 435.333L302.083 425.902ZM355.701 425.902L353.221 455.548L349.229 503.211H345.5L336.153 457.314L331.682 435.333L355.701 425.902Z" fill="#DADBE0"></path>
              <path d="M278.063 435.333L302.083 425.939L299.434 457.436C293.46 457.051 287.692 456.496 282.206 455.717L278.063 435.333ZM355.701 425.902L353.212 455.548C347.782 456.318 342.071 456.91 336.153 457.314L331.682 435.333L355.701 425.902Z" fill="black" opacity="0.15"></path>
              <path d="M318.108 202.692C302.571 204.392 285.231 199.874 278.063 195.017C276.833 194.294 275.8 193.278 275.057 192.058C274.278 190.508 273.592 188.902 272.916 187.202C271.976 184.872 271.169 182.449 270.445 180.025C268.518 173.72 267.17 167.252 266.415 160.703C266.415 160.167 266.218 158.57 266.021 156.72C265.345 148.425 265.006 141.69 264.809 137.069C265.204 137.745 267.139 140.901 268.886 140.61C270.765 140.225 272.333 136.092 271.901 130.174H307.136L321.847 142.893C321.847 142.893 322.279 144.931 323.199 148.031C324.69 153.477 326.558 158.813 328.789 164C330.667 168.321 332.912 172.304 335.364 174.727C343.49 182.468 336.745 200.747 318.108 202.692Z" fill="#FFCB9D" style="fill: #FFCB9D; fill: var(--tblr-illustrations-skin, #FFCB9D);"></path>
              <path d="M328.788 164C315.373 168.775 300.746 168.931 287.231 164.441C283.781 164.927 280.531 166.354 277.838 168.565C273.855 171.919 273.958 175.018 270.755 179.584L270.464 180.025C268.537 173.72 267.188 167.252 266.434 160.703C266.434 160.167 266.237 158.57 266.039 156.72C265.363 148.425 265.025 141.69 264.828 137.069C265.222 137.745 267.157 140.901 268.904 140.61C270.783 140.225 272.352 136.092 271.92 130.174H307.155L321.865 142.893C321.865 142.893 322.297 144.931 323.218 148.031C324.703 153.476 326.564 158.812 328.788 164Z" fill="black" opacity="0.1"></path>
              <path d="M353.502 268.466C356.893 286.755 359.298 300.197 360.951 309.666C361.045 310.192 361.13 310.718 361.224 311.244C363.196 322.244 365.225 333.253 367.198 344.272C330.2 344.935 293.193 345.649 256.176 346.413C256.232 343.868 256.27 341.238 256.335 338.673V338.542C255.228 310.418 255.658 282.255 257.622 254.178C257.763 252.102 257.913 250.045 258.083 247.978L252.54 260.923L230.334 247.772C231.132 244.258 233.922 233.681 242.132 226.448C242.132 226.448 249.581 219.967 257.895 218.792C258.667 218.721 259.432 218.596 260.187 218.417C260.319 218.382 260.454 218.357 260.591 218.342C265.334 217.665 269.928 217.055 274.249 216.726C284.754 215.813 295.312 215.656 305.839 216.256C315.93 216.869 325.952 218.314 335.805 220.577C338.285 221.169 340.868 221.845 343.32 222.653L345.405 223.358C345.668 223.442 345.922 223.517 346.166 223.611L347.537 224.109C349.097 224.71 364.606 229.229 368.006 230.271C371.821 231.512 375.321 233.566 378.264 236.293L364.089 275.464L353.502 268.466Z" fill="#0455A4" style="fill: #0455A4; fill: var(--tblr-illustrations-primary, var(--tblr-primary, #0455A4));"></path>
              <path d="M271.554 222.127C271.554 233.832 285.644 243.3 303.069 243.3C320.494 243.3 334.519 233.832 334.519 222.127C334.52 221.496 334.457 220.867 334.331 220.249C324.476 217.949 314.441 216.504 304.337 215.927C293.815 215.329 283.263 215.495 272.765 216.425C271.953 218.216 271.539 220.161 271.554 222.127Z" fill="#FFCB9D" style="fill: #FFCB9D; fill: var(--tblr-illustrations-skin, #FFCB9D);"></path>
              <path d="M337.524 142.451C335.044 147.89 329.361 151.845 328.591 152.361C312.133 163.511 287.334 150.849 280.684 147.063C279.03 151.572 274.756 154.973 274.221 157.744C274.08 158.57 273.939 159.397 273.836 160.167C273.671 161.504 273.593 162.85 273.601 164.197C273.65 166.483 273.908 168.759 274.371 170.998C275.188 174.887 278.664 185.22 284.347 198.681C276.388 199.207 268.422 199.742 260.45 200.287L241.108 201.583C238.404 192.37 237.788 182.669 239.305 173.187C239.446 172.341 239.671 171.101 240.009 169.551C240.72 166.396 241.662 163.297 242.827 160.28C243.034 159.754 243.26 159.209 243.485 158.664C245.146 154.767 247.194 151.047 249.6 147.561C255.842 138.551 264.069 131.095 273.648 125.768C276.945 124.04 298.071 113.19 319.563 120.808C324.908 122.687 337.618 127.262 338.689 136.148C338.907 138.317 338.503 140.503 337.524 142.451ZM291.204 514.539C285.803 516.324 285.718 525.182 285.718 525.182L284.253 534.219L294.68 536.68L297.658 529.578L316.905 536.68C312.885 527.38 296.615 512.764 291.204 514.539ZM368.72 536.68C364.69 527.38 348.42 512.764 343.019 514.539C337.618 516.315 337.524 525.182 337.524 525.182L336.068 534.219L346.476 536.68L349.454 529.578L368.72 536.68Z" fill="#232B41" class="tblr-illustrations-boy-girl-c"></path>
              <path d="M337.524 142.451C335.044 147.89 329.371 151.845 328.591 152.352C312.133 163.521 287.335 150.849 280.684 147.063C278.366 144.912 276.281 142.523 274.465 139.934C283.982 145.468 294.71 148.587 305.711 149.018C316.712 149.448 327.651 147.178 337.571 142.404L337.524 142.451Z" fill="black" opacity="0.3"></path>
              <path d="M373.051 435.333H258.947L256.956 371.738L256.176 346.423L367.199 344.262L371.942 418.002L373.051 435.333Z" fill="#A6A9B3"></path>
              <path d="M373.05 435.333H258.947L257.632 345.615L313.392 345.249C292.67 386.214 286.602 401.469 288.274 402.85C290.566 404.729 306.121 379.122 314.003 383.527C316.868 385.134 317.168 389.849 317.985 393.005C320.531 402.756 332.226 413.455 371.942 418.002L373.05 435.333Z" fill="black" opacity="0.1"></path>
              <path d="M346.241 223.63H346.194L345.433 223.386C342.371 236.997 324.552 247.48 303.087 247.48C279.425 247.48 260.177 234.799 260.177 219.225V218.436C259.454 218.548 258.693 218.67 257.904 218.821C257.895 218.955 257.895 219.09 257.904 219.225C257.904 236.283 278.166 250.223 303.087 250.223C325.51 250.223 344.156 238.951 347.603 224.194L346.241 223.63Z" fill="#E1E1E1"></path>
              <path d="M307.502 263.853C309.411 263.853 310.959 262.011 310.959 259.739C310.959 257.467 309.411 255.625 307.502 255.625C305.593 255.625 304.045 257.467 304.045 259.739C304.045 262.011 305.593 263.853 307.502 263.853Z" fill="#E1E1E1"></path>
              <path d="M260.404 200.315L241.063 201.612C238.358 192.398 237.742 182.697 239.259 173.215C239.4 172.37 239.625 171.13 239.964 169.58L242.782 160.308C242.988 159.782 243.214 159.237 243.439 158.693C245.1 154.796 247.148 151.076 249.554 147.589C248.615 159.989 248.474 177.273 253.744 188.263C255.706 192.418 257.931 196.443 260.404 200.315Z" fill="black" opacity="0.3"></path>
              <path d="M367.199 344.272C330.201 344.935 293.193 345.649 256.176 346.413C256.233 343.868 256.27 341.238 256.336 338.673V338.542C315.929 341.501 350.957 319.557 361.224 311.244C363.197 322.244 365.264 333.253 367.199 344.272Z" fill="black" opacity="0.1"></path>
              <path d="M280.017 380.052C274.531 389.041 263.503 391.437 255.35 384.965C250.399 380.597 225.45 357.564 220.594 316.006C218.13 294.148 221.708 272.032 230.936 252.064C231.509 250.843 232.007 249.829 232.429 249.002L249.723 259.119C249.103 260.124 248.173 261.674 247.13 263.637C243.063 271.34 237.267 285.609 240.743 300.272C242.621 308.276 246.266 313.912 253.706 324.695C259.993 333.807 267.133 342.299 275.029 350.058C283.671 356.662 285.804 370.564 280.017 380.052Z" fill="#FFCB9D" style="fill: #FFCB9D; fill: var(--tblr-illustrations-skin, #FFCB9D);"></path>
              <path d="M249.723 259.119C249.103 260.124 248.173 261.674 247.13 263.637C242.33 260.274 234.862 255.005 230.926 252.064C231.499 250.843 231.997 249.829 232.42 249.002L249.723 259.119Z" fill="black" opacity="0.15"></path>
              <path d="M304.337 215.899C293.815 215.301 283.264 215.467 272.766 216.397C271.949 218.196 271.536 220.152 271.554 222.127C271.554 233.832 285.644 243.3 303.069 243.3C320.494 243.3 334.519 233.832 334.519 222.127C334.52 221.496 334.457 220.867 334.331 220.248C324.477 217.94 314.442 216.485 304.337 215.899Z" fill="black" opacity="0.07"></path>
              <path d="M445.325 188.01C446.283 199.188 447.25 210.351 448.227 221.498L453.863 286.182C455.329 302.909 456.785 319.645 458.231 336.39H543.713C545.372 319.639 547.038 302.902 548.71 286.182C549.668 276.701 550.608 267.223 551.528 257.748C553.852 234.489 556.162 211.243 558.461 188.01H445.325Z" fill="#DADBE0"></path>
              <path d="M555.464 217.844C547.072 224.328 539.267 231.538 532.14 239.393C515.429 257.766 513.109 267.62 505.171 271.03C495.956 274.994 479.809 269.997 449.542 228.045L453.995 288.474H454.042C455.445 304.443 456.835 320.412 458.213 336.381H543.694C545.354 319.642 547.019 302.909 548.692 286.182H549.058L555.464 217.844Z" fill="black" opacity="0.1"></path>
              <path d="M420.385 276.76C422.47 282.504 425.273 287.961 428.727 293.002C429.744 294.46 430.829 295.871 431.977 297.229C436.998 303.248 443.375 307.99 450.585 311.065C454.275 312.632 458.128 313.779 462.074 314.485C467.561 315.468 473.147 315.784 478.71 315.424C479.17 315.424 479.649 315.377 480.072 315.34C480.247 315.35 480.423 315.35 480.598 315.34L481.631 315.255L482.12 315.208H482.458C486.709 314.762 490.926 314.037 495.083 313.038H495.148C498.827 312.155 502.453 311.064 506.007 309.769C507.604 309.215 509.145 308.604 510.62 307.956C512.674 307.067 514.615 306.128 516.444 305.138C519.749 303.381 522.934 301.407 525.978 299.23C527.35 298.243 528.608 297.294 529.736 296.411C522.502 293.161 515.26 289.892 508.018 286.661C503.784 284.782 499.557 282.882 495.336 280.959C493.604 282.328 491.712 283.479 489.7 284.388C488.168 285.069 486.55 285.537 484.891 285.778C483.818 285.965 482.727 286.028 481.64 285.966C478.4 285.778 475.347 284.181 472.51 281.617C472.363 281.502 472.225 281.376 472.097 281.241C470.798 280.007 469.592 278.679 468.489 277.267C456.841 262.407 449.702 233.681 449.702 233.681C452.924 222.879 453.119 211.399 450.266 200.494C449.097 196.178 447.436 192.011 445.316 188.076C440.947 188.898 436.792 190.601 433.104 193.082C431.175 194.4 429.398 195.928 427.806 197.638C412.607 213.861 410.268 249.528 420.385 276.76Z" fill="#DADBE0"></path>
              <path d="M445.325 188.01C438.625 189.246 432.498 192.598 427.844 197.572C412.607 213.861 410.268 249.528 420.385 276.76C422.47 282.504 425.273 287.961 428.727 293.002C429.744 294.46 430.828 295.871 431.977 297.229C436.998 303.248 443.375 307.99 450.585 311.065C452.425 311.844 454.306 312.518 456.221 313.085L458.26 336.39H543.741C545.401 319.639 547.067 302.902 548.739 286.182C549.697 276.694 550.636 267.216 551.557 257.748C553.861 234.489 556.163 211.243 558.461 188.01H445.325Z" fill="black" opacity="0.05"></path>
              <path d="M540.181 104.661C540.002 109.282 539.636 116.055 538.95 124.387C538.762 126.266 538.621 127.816 538.584 128.37C537.518 137.473 535.309 146.404 532.008 154.954C531.322 156.654 530.637 158.251 529.857 159.81C526.973 165.578 505.434 172.529 486.703 170.472C467.972 168.415 461.256 150.201 469.353 142.413C471.824 139.99 474.116 136.007 475.994 131.667C478.228 126.463 480.092 121.108 481.574 115.642C482.513 112.533 482.946 110.475 482.946 110.475L497.712 97.7471H533.041C532.628 103.703 534.187 107.817 536.057 108.183C537.926 108.55 539.767 105.346 540.181 104.661Z" fill="#FFCB9D" style="fill: #FFCB9D; fill: var(--tblr-illustrations-skin, #FFCB9D);"></path>
              <path d="M540.181 104.661C540.002 109.282 539.636 116.055 538.95 124.387C538.762 126.266 538.621 127.816 538.584 128.37C537.519 137.473 535.309 146.404 532.008 154.954C529.719 154.235 527.589 153.083 525.734 151.563C523.719 149.859 522.057 147.779 520.839 145.438C519.612 142.93 518.785 140.246 518.388 137.482C518.04 135.703 517.795 133.906 517.655 132.099C504.109 136.607 489.444 136.455 475.995 131.667C478.228 126.463 480.092 121.108 481.574 115.642C482.514 112.533 482.946 110.475 482.946 110.475L497.713 97.7471H533.042C532.628 103.703 534.188 107.817 536.057 108.183C537.926 108.55 539.768 105.346 540.181 104.661Z" fill="black" opacity="0.1"></path>
              <path d="M544.53 112.213C544.324 119.897 540.998 127.365 536.32 131.846C535.242 132.734 534.228 133.698 533.286 134.73C530.89 137.732 529.277 141.283 528.589 145.062C526.945 143.089 525.93 140.668 525.677 138.111C525.433 134.213 527.105 127.027 527.19 126.022C527.19 126.022 527.19 125.749 527.274 125.43C527.274 124.876 527.359 124.65 527.434 123.786C527.564 121.91 527.564 120.026 527.434 118.15C527.455 118.06 527.455 117.967 527.434 117.877C518.491 123.326 493.007 136.599 475.854 123.514C473.188 121.482 470.828 119.078 468.846 116.375C468.641 116.159 468.473 115.912 468.349 115.642C467.865 114.969 467.426 114.267 467.033 113.538C466.996 113.476 466.955 113.416 466.911 113.359V113.312C465.865 111.449 465.141 109.423 464.77 107.319L464.638 106.492C464.561 105.555 464.561 104.612 464.638 103.674C465.122 100.035 466.851 96.6762 469.532 94.1681C474.501 89.2271 481.838 86.2963 485.698 84.7746C500.728 78.7345 523.489 77.2597 536.424 90.8616C539.662 94.4155 542.023 98.678 543.319 103.308C544.136 106.205 544.544 109.203 544.53 112.213Z" fill="#232B41" class="tblr-illustrations-boy-girl-c"></path>
              <path d="M527.378 117.887C518.435 123.335 492.95 136.608 475.798 123.523C473.131 121.492 470.771 119.087 468.79 116.384C468.585 116.169 468.417 115.921 468.292 115.651C467.809 114.979 467.37 114.276 466.977 113.547C466.94 113.485 466.899 113.426 466.855 113.369V113.322C465.828 111.452 465.123 109.423 464.77 107.319C468.771 111.224 473.388 114.442 478.437 116.844C503.452 128.586 529.679 113.951 533.859 111.621L534.179 111.433C532.074 113.75 529.801 115.907 527.378 117.887Z" fill="black" opacity="0.3"></path>
              <path d="M543.657 336.39L536.311 514.22H521.873L501.893 376.83L488.178 514.22H477.479L458.213 336.39H543.657Z" fill="#0455A4" style="fill: #0455A4; fill: var(--tblr-illustrations-primary, var(--tblr-primary, #0455A4));"></path>
              <path d="M505.697 538.906L537.926 535.318C537.926 535.318 539.091 526.967 534.037 524.046C528.984 521.124 510.967 531.081 505.697 538.906ZM458.26 538.906L490.479 535.318C490.479 535.318 491.644 526.967 486.6 524.046C481.556 521.124 463.473 531.081 458.26 538.906ZM420.385 276.76C422.47 282.504 425.272 287.961 428.726 293.002C434.133 300.991 441.72 307.26 450.585 311.065C451.487 303.348 449.862 295.547 445.954 288.831C439.472 277.634 428.754 272.852 420.385 276.76Z" fill="#232B41" class="tblr-illustrations-boy-girl-c"></path>
              <path d="M513.447 185.699C505.434 193.674 497.788 196.624 491.964 197.694L491.024 197.864L478.165 187.756L513.447 185.699Z" fill="#E1E1E1"></path>
              <path d="M450.867 241.44C454.744 254.128 458.629 266.812 462.525 279.494C469.157 287.839 476.911 295.226 485.567 301.446C499.357 311.235 521.995 322.187 542.238 321.474C552.74 321.126 562.594 317.632 570.231 309.262C576.534 302.32 579.559 294.054 582.555 282.518C583.298 279.653 584.049 276.6 584.838 273.303C586.999 264.379 593.424 236.546 584.575 211.588C581.353 202.523 577.69 198.211 575.651 196.154C573.275 193.74 570.476 191.782 567.394 190.377C564.57 189.104 561.548 188.323 558.461 188.066C558.301 188.93 558.085 190.18 557.841 191.683C557.08 196.379 556.592 200.362 556.282 203.105C556.188 203.979 556.037 205.35 555.887 207.013C555.53 210.77 555.27 214.393 555.107 217.881C555.029 225.279 553.997 232.635 552.036 239.768C550.243 246.356 547.577 252.675 544.108 258.555C535.992 262.148 527.347 264.4 518.51 265.225C486.168 268.165 461.285 250.148 450.867 241.44Z" fill="#DADBE0"></path>
              <path d="M542.238 321.492C552.74 321.145 562.594 317.65 570.231 309.281C576.534 302.339 579.558 294.073 582.555 282.537C575.547 283.683 567.469 287.741 559.898 294.458C550.861 302.433 544.586 312.475 542.238 321.492Z" fill="#232B41" class="tblr-illustrations-boy-girl-c"></path>
              <path d="M488.178 514.22L501.893 376.83L495.778 336.39H458.213L477.479 514.22H488.178Z" fill="black" opacity="0.22"></path>
              <path d="M494.801 195.468L473.956 180.495L469.194 185.539L483.359 206.694L494.801 195.468ZM495.778 195.318L527.368 175.629L534.582 182.261L513.118 210.075L495.778 195.318Z" fill="#0455A4" style="fill: #0455A4; fill: var(--tblr-illustrations-primary, var(--tblr-primary, #0455A4));"></path>
              <path d="M494.801 195.468L473.956 180.495L469.194 185.539L483.359 206.694L494.801 195.468Z" fill="black" opacity="0.22"></path>
            </svg>
            <h1 class="mt-5">SpringCMS Installer</h1>
            <p class="text-secondary"></p>
          </div>
          <div class="card-body">
            <h1>System Requirements</h1>
            <ul id="requirements-list">
                <!-- Will be populated via JavaScript -->
            </ul>
            {{-- <button id="check-requirements" class="btn btn-primary btn-sm">Check Requirements</button> --}}
            {{-- <a href="{{ route('install.database') }}">Next</a> --}}
          </div>
        </div>
        <div class="row align-items-center mt-3">
          <div class="col-4">
            <div class="progress">
              <div class="progress-bar" style="width: 25%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" aria-label="25% Complete">
                <span class="visually-hidden">25% Complete</span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="btn-list justify-content-end">
              {{-- <a href="#" class="btn btn-link link-secondary">
                Set up later
              </a> --}}
              <a href="{{ route('install.database') }}" class="btn btn-primary">
                Next
              </a>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        fetch("{{ route('install.checkRequirements') }}")
          .then(response => response.json())
          .then(data => {
              let list = document.getElementById('requirements-list');
              list.innerHTML = '';
              for (const [requirement, result] of Object.entries(data)) {
                  let listItem = document.createElement('li');
                  listItem.innerText = `${requirement}: ${result ? '✓' : '✗'}`;
                  listItem.style.color = result ? 'green' : 'red';
                  list.appendChild(listItem);
              }
          });
      });
    </script>
@endpush
