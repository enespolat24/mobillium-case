import Navbar from "@/Components/Navbar";

export default function Show({ auth, post }) {
    const date = new Date(post.created_at);
    const formattedDate = `${date.getFullYear()}-${String(
        date.getMonth() + 1
    ).padStart(2, "0")}-${String(date.getDate()).padStart(2, "0")}`;
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
                        {/* Add more author details if available */}
                    </div>
                </div>
            </div>
        </>
    );
}
