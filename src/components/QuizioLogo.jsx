import QuizioIcon from "../assets/icons/QuizioIcon";

export default function QuizioLogo({ className }) {
   return (
      <div className={`flex gap-3 justify-center ${className}`}>
         <QuizioIcon />
         <span className="text-[28px] text-white font-semibold">Quizio</span>
      </div>
   );
}
