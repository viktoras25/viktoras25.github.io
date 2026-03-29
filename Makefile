build:
	npm run build

serve:
	container run --rm -it --init -p 8000:8000 -v `pwd`:/app viktoras25/sculpin:3.3.0-alpha4 generate --watch --server --env=live

clean:
	rm -rf output_live
