export default function Button({
   color = "primary",
   size = "large",
   type = "button",
   className,
   children,
   ...props
}) {
   const buttonColor = {
      primary: " bg-primary text-white inset-ring-white/35",
      "gray-outlie": "bg-transparent text-gray inset-ring-gray",
   };

   const buttonSize = {
      small: "py-2 px-3 text-sm",
      large: "py-3 px-6 text-base",
   };

   const classes = `cursor-pointer inset-ring-2 font-semibold rounded-lg ${buttonColor[color]} ${buttonSize[size]} ${className}`;

   return (
      <button className={classes} type={type} {...props}>
         {children}
      </button>
   );
}
