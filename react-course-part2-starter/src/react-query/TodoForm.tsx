import { useRef } from "react";

const TodoForm = () => {
  const ref = useRef<HTMLInputElement>(null);

  return (
    <form
      className="row mb-3"
      onSubmit={(e) => {
        e.preventDefault();
        if (ref.current?.value) {
          console.log(ref.current.value);
          ref.current.value = "";
        }
      }}
    >
      <div className="col">
        <input ref={ref} type="text" className="form-control" />
      </div>
      <div className="col">
        <button className="btn btn-primary">Add</button>
      </div>
    </form>
  );
};

export default TodoForm;
