ARG buildno

RUN echo "Build number: $buildno"

EXPOSE 8000

# Define environment variable
ENV NAME Laravel-rest

# Run app.py when the container launches
CMD ["php", "artisan serve"]