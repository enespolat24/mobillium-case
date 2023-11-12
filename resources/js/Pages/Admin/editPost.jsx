import { Link, router } from "@inertiajs/react";
import { useState } from "react";

export default function EditPost({ post }) {
    const [values, setValues] = useState({
        title: post.title,
        content: post.content,
        published: post.is_published,
    });
    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value;
        setValues((values) => ({
            ...values,
            [key]: value,
        }));
    }

    function handleSubmit(e) {
        e.preventDefault();
        router.post(route("posts.edit", post), values);
        window.alert("Post updated successfully!");
    }

    return (
        <>
            <div className="mb-6 text-center my-12">
                <Link
                    href={route("admin.dashboard")}
                    className="text-blue-500 hover:text-blue-700 font-bold text-sm mb-2 block"
                >
                    <svg
                        className="w-4 h-4 inline-block mr-1"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>
                    Back
                </Link>
            </div>
            <form
                onSubmit={handleSubmit}
                className="w-full max-w-md mx-auto my-4 bg-white shadow-md rounded px-8 pt-6 pb-8"
            >
                <div className="mb-4">
                    <label
                        htmlFor="title"
                        className="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Title:
                    </label>
                    <input
                        id="title"
                        value={values.title}
                        onChange={handleChange}
                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                </div>

                <div className="mb-4">
                    <label
                        htmlFor="content"
                        className="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Content:
                    </label>
                    <textarea
                        id="content"
                        value={values.content}
                        onChange={handleChange}
                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    ></textarea>
                </div>

                <div className="mb-4">
                    <label
                        htmlFor="published"
                        className="inline text-gray-700 text-sm font-bold mb-2"
                    >
                        Published:
                    </label>
                    <input
                        type="checkbox"
                        id="published"
                        value={values.is_published == 1}
                        onChange={handleChange}
                        className="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                </div>

                <div className="mb-6">
                    <button
                        type="submit"
                        className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </>
    );
}
