import QuizioIcon from "../assets/icons/QuizioIcon";

export default function Header({ children }) {
   return (
      <header className="p-4 min-sm:p-10 flex justify-between mb-[50px]">
         <div className="flex gap-3 justify-center">
            <QuizioIcon />
            <span className="text-[28px] text-white font-semibold max-sm:hidden">Quizio</span>
         </div>
         <div className="space-x-4">{children}</div>
      </header>
   );
}
