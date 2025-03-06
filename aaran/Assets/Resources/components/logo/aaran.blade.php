@props(['brand'])

<span class="inline-flex justify-center items-center">

    @switch($brand)

        @case('aaran')

            <svg xmlns="http://www.w3.org/2000/svg"
                 xml:space="preserve" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                 image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                 viewBox="0 0 6251.85 5666.12"
             {{ $attributes }}>
                 <g>
                  <polygon fill="#F7C028"
                           points="1256.08,4375.12 -0,4366.54 2599.16,0 3044.38,582.14 1188.03,3700.78 1655.58,3703.99 "/>
                  <polygon fill="#F7C028" points="4551.12,4408.84 2520.51,4392.29 2919.64,3721.74 4163.62,3735.94 "/>
                  <polygon fill="#FF321E"
                           points="3184.93,1616.13 3836.55,542.26 6251.85,5013.13 5523.77,5096.72 3798.73,1903.59 3556.15,2303.31 "/>
                  <polygon fill="#FF321E" points="1451,4371.45 2506.73,2636.77 2877.63,3323.32 2227.41,4383.92 "/>
                  <polygon fill="#3DC1F0"
                           points="4603.18,4579.12 5232.64,5666.12 151.13,5639.72 427.18,4960.82 4056.43,4979.67 3822.16,4575.04 "/>
                  <polygon fill="#3DC1F0" points="3087.59,1797.72 4093.88,3540.77 3313.56,3536.72 2686.73,2451 "/>
                 </g>
            </svg>




            @break


        @case('aaran_associates')

            <svg xmlns="http://www.w3.org/2000/svg"
                 xml:space="preserve"
                 shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                 image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                 viewBox="0 0 1928.64 1283.78"
        {{ $attributes }}>
     <g>
         <polygon fill="#1A1A1A" points="1928.64,1280.84 1286.75,0 644.86,0 1283.82,1280.84 "/>
         <polygon fill="#559920" points="-0,1283.78 641.89,2.93 1283.78,2.93 644.81,1283.78 "/>
         <polygon fill="#6EB33A" points="964.3,643.35 644.81,1281.78 316.53,652.16 "/>
         <polygon fill="#41515E" points="964.65,641.19 1284.13,1279.61 1612.41,649.99 "/>
     </g>
</svg>
            @break



        @default
            Default case...
    @endswitch
    </span>




