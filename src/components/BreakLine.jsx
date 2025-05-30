export default function BreakLine({ children = "TEXT" }) {
   return (
      <div className="text-gray flex items-center gap-3">
         <hr className="border-gray grow" />
         <p className="text-base font-semibold">{children}</p>
         <hr className="border-gray grow" />
      </div>
   );
}
