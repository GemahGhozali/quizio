export default function RadioButton({ label, name, value, ...props }) {
   return (
      <>
         <label className="group w-full cursor-pointer block">
            <input type="radio" className="sr-only" name={name} value={value} {...props} />
            <div className="w-full rounded-md p-4 text-gray inset-ring-1 inset-ring-gray group-has-[input:checked]:text-indigo group-has-[input:checked]:inset-ring-indigo group-has-[input:checked]:bg-indigo/10">
               <div className="flex items-center gap-4">
                  <div className="size-6 rounded-full inset-ring-2 grid place-content-center group-has-[input:checked]:inset-ring-indigo">
                     <div className="size-3 rounded-full hidden group-has-[input:checked]:block bg-indigo"></div>
                  </div>
                  <p className="text-base">{label}</p>
               </div>
            </div>
         </label>
      </>
   );
}
