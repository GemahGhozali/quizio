import "./styles/index.css";

// COMPONENTS
import Button from "./components/Button";
import BreakLine from "./components/BreakLine";
import Input from "./components/Input";
import TextArea from "./components/TextArea";
import RadioButton from "./components/RadioButton";
import RoleRadioButton from "./components/RoleRadioButton";

// ICONS
import EmailIcon from "./assets/icons/EmailIcon";
import EducationIcon from "./assets/icons/EducationIcon";
import UserIcon from "./assets/icons/UserIcon";

function App() {
   return (
      <div className="bg-light-black h-dvh">
         {/* BUTTON */}
         <Button>Button</Button>

         {/* BREAKLINE */}
         <BreakLine>BREAKLINE</BreakLine>

         {/* INPUT */}
         <Input type="text" label="Email" placeholder="Email Here..." name="email" Icon={EmailIcon} />

         {/* TEXTAREA */}
         <TextArea label="Description" placeholder="Description Here" name="description" />

         {/* RADIOBUTTON */}
         <RadioButton label="Teacher" name="role" value="teacher" />
         <RadioButton label="Student" name="role" value="student" />

         {/* RADIO BUTTON FOR ROLE */}
         <RoleRadioButton Icon={EducationIcon} label="Teacher" name="role" value="teacher" />
         <RoleRadioButton Icon={UserIcon} label="Student" name="role" value="student" />
      </div>
   );
}

export default App;
