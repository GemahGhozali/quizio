export default function QuizioIcon({ className }) {
   return (
      <svg
         width="44"
         height="44"
         viewBox="0 0 44 44"
         fill="none"
         xmlns="http://www.w3.org/2000/svg"
         className={className}>
         <path
            fillRule="evenodd"
            clipRule="evenodd"
            d="M22 34.4667C28.8852 34.4667 34.4667 28.8851 34.4667 22C34.4667 15.1149 28.8852 9.53333 22 9.53333C15.1149 9.53333 9.53335 15.1149 9.53335 22C9.53335 28.8851 15.1149 34.4667 22 34.4667ZM22 44C34.1503 44 44.0001 34.1503 44.0001 22C44.0001 9.84974 34.1503 0 22 0C9.84975 0 0 9.84974 0 22C0 34.1503 9.84975 44 22 44Z"
            fill="url(#paint0_linear_137_151)"
         />
         <g filter="url(#filter0_d_137_151)">
            <path
               d="M22.2518 22.4817C24.5429 20.1906 28.2574 20.1906 30.5485 22.4817L41.9565 33.8897C44.2476 36.1807 44.2476 39.8953 41.9565 42.1864C39.6654 44.4775 35.9509 44.4775 33.6598 42.1864L22.2518 30.7784C19.9607 28.4873 19.9607 24.7727 22.2518 22.4817Z"
               fill="url(#paint1_linear_137_151)"
            />
         </g>
         <defs>
            <filter
               id="filter0_d_137_151"
               x="10.5334"
               y="10.7634"
               width="43.1414"
               height="43.1413"
               filterUnits="userSpaceOnUse"
               colorInterpolationFilters="sRGB">
               <feFlood floodOpacity="0" result="BackgroundImageFix" />
               <feColorMatrix
                  in="SourceAlpha"
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                  result="hardAlpha"
               />
               <feOffset />
               <feGaussianBlur stdDeviation="5" />
               <feComposite in2="hardAlpha" operator="out" />
               <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 1 0" />
               <feBlend
                  mode="normal"
                  in2="BackgroundImageFix"
                  result="effect1_dropShadow_137_151"
               />
               <feBlend
                  mode="normal"
                  in="SourceGraphic"
                  in2="effect1_dropShadow_137_151"
                  result="shape"
               />
            </filter>
            <linearGradient
               id="paint0_linear_137_151"
               x1="44.0001"
               y1="22"
               x2="0"
               y2="22"
               gradientUnits="userSpaceOnUse">
               <stop offset="0.1" stopColor="#FF6544" />
               <stop offset="1" stopColor="#761BFF" />
            </linearGradient>
            <linearGradient
               id="paint1_linear_137_151"
               x1="41.9565"
               y1="42.1864"
               x2="22.2518"
               y2="22.4817"
               gradientUnits="userSpaceOnUse">
               <stop offset="0.1" stopColor="#FF6544" />
               <stop offset="1" stopColor="#761BFF" />
            </linearGradient>
         </defs>
      </svg>
   );
}
