export default function TextArea({ label, placeholder, name, className }) {
   return (
      <div className={`space-y-3 ${className}`}>
         {label && <label className="font-semibold text-white text-base block">{label}</label>}
         <textarea placeholder={placeholder} name={name} className="resize-none w-full px-4 py-3.5 rounded-lg text-base text-white inset-ring inset-ring-gray bg-light-black placeholder:text-gray" rows="5"></textarea>
      </div>
   );
}
