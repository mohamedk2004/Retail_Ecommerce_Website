from flask import Flask, request, jsonify
from flask_cors import CORS
import google.generativeai as genai

# Configure the Generative AI API with your API key
genai.configure(api_key="AIzaSyCESxBtvEydjNlrERAF8iLmDWD8AQYzYIM")
model = genai.GenerativeModel("gemini-1.5-flash")

# Initialize Flask app
app = Flask(__name__)  # Correct use of __name__
CORS(app)  # Enable CORS if frontend and backend are on different domains/ports

# Route for chatbot message generation
@app.route('/generate', methods=['POST'])
def generate():
    data = request.json
    print(f"Received request: {data}")  # Log request payload
    prompt = data.get("prompt", "")

    try:
        # Generate response using the AI model
        response = model.generate_content(prompt)
        print(f"Generated response: {response.text}")  # Log AI response
        return jsonify({"response": response.text})
    except Exception as e:
        print(f"Error: {str(e)}")  # Log exception
        return jsonify({"error": str(e)}), 500

# Run the Flask app
if __name__ == "__main__":  # Correct use of __name__
    app.run(debug=True)
