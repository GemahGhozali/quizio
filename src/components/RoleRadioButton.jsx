export default function RoleRadioButton({ label, Icon, name, value, ...props }) {
   return (
      <>
         <label className="group w-full cursor-pointer block">
            <input type="radio" className="sr-only" name={name} value={value} {...props} />
            <div className="p-[1.5px] rounded-lg bg-gray group-has-[input:checked]:bg-gradient-to-r group-has-[input:checked]:from-10% group-has-[input:checked]:from-indigo group-has-[input:checked]:to-red inline-block w-full">
               <div className="rounded-md bg-light-black px-6 py-3 flex items-center gap-2 justify-center fill-gray group-has-[input:checked]:fill-indigo">
                  {Icon && <Icon />}
                  <p className="text-base text-gray group-has-[input:checked]:font-semibold group-has-[input:checked]:bg-gradient-to-r group-has-[input:checked]:from-10% group-has-[input:checked]:from-indigo group-has-[input:checked]:to-red group-has-[input:checked]:text-transparent group-has-[input:checked]:bg-clip-text">
                     {label}
                  </p>
               </div>
            </div>
         </label>
      </>
   );
}
