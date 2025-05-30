export default function Input({ label, type, placeholder, name, Icon, className, ...props }) {
   return (
      <div className={`space-y-3 ${className}`}>
         {label && <label className="font-semibold text-white text-base block">{label}</label>}
         <div className="flex items-center gap-3 w-full px-4 py-3.5 rounded-lg inset-ring inset-ring-gray bg-light-black">
            {Icon && <Icon />}
            <input type={type} placeholder={placeholder} name={name} className="grow text-base text-white placeholder:text-gray" {...props} />
         </div>
      </div>
   );
}
