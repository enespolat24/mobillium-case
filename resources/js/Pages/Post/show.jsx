import Navbar from "@/Components/Navbar";
import { usePage, router, Link } from "@inertiajs/react";
import { useState } from "react";

export default function Show({ auth, post, nextPost, prevPost }) {
    const [rating, setRating] = useState(0);

    const handleRatingChange = (value) => {
        setRating(value);
    };

    const date = new Date(post.created_at);
    const formattedDate = `${date.getFullYear()}-${String(
        date.getMonth() + 1
    ).padStart(2, "0")}-${String(date.getDate()).padStart(2, "0")}`;

    function handleSubmit(e) {
        e.preventDefault();
        if (auth.user) {
            router.post(route("vote.post", post), { rating: rating });
        } else {
            window.alert("Please login to rate this post!");
        }
    }

    return (
        <>
            <Navbar auth={auth} />
            <div className="max-w-4xl mx-auto p-8">
                <div className="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div className="px-6 py-4">
                        <h1 className="text-2xl font-semibold mb-2">
                            {post.title}
                        </h1>
                        <p className="text-gray-700 text-base leading-relaxed">
                            {post.content}
                        </p>
                        <div className="mt-4 flex justify-between items-center">
                            <p className="text-gray-600">
                                View count: {post.view_count}
                            </p>
                            <p className="text-gray-600">
                                Rating: {post.rating}
                            </p>
                        </div>
                        <div className="mt-12">
                            <p className="mb-2">Rate from 1 to 5:</p>
                            <div className="flex space-x-2">
                                {[1, 2, 3, 4, 5].map((value) => (
                                    <label
                                        key={value}
                                        className="flex items-center"
                                    >
                                        <input
                                            type="radio"
                                            name="rating"
                                            value={value}
                                            checked={rating === value}
                                            onChange={() =>
                                                handleRatingChange(value)
                                            }
                                            className="form-radio h-5 w-5 text-blue-600"
                                        />
                                        <span className="ml-2">{value}</span>
                                    </label>
                                ))}
                                <button
                                    onClick={handleSubmit}
                                    className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                >
                                    Rate
                                </button>
                            </div>
                            <p className="mt-2">Selected Rating: {rating}</p>
                        </div>
                        <p className="mt-4 text-gray-600">
                            Published on {formattedDate}
                        </p>
                    </div>
                    <div className="p-6 border-t border-gray-200">
                        <h2 className="text-xl font-semibold mb-2">
                            About the author
                        </h2>
                        <p className="text-gray-700">
                            Name: {post.author.name}
                        </p>
                        <p className="text-gray-700">
                            Email: {post.author.email}
                        </p>
                    </div>
                    <div className="flex justify-between mt-4">
                        <div className="text-indigo-600 hover:text-indigo-900">
                            <Link href={route("posts.view", prevPost.slug)}>
                                &larr; Previous post
                            </Link>
                        </div>
                        <div className="text-indigo-600 hover:text-indigo-900">
                            <Link href={route("posts.view", nextPost.slug)}>
                                Next post &rarr;
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
